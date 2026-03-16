<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\CaptchaService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewService $reviewService
    ) {}

    /**
     * Получить активные модули пользователя [id => name]
     */
    private function getActiveModules(): array
    {
        $activeModules = [];
        $user = auth()->user();

        if ($user) {
            $user->load('activeModules.module');
            $activeModules = $user->activeModules->pluck('module.name', 'module.id')->toArray();
        }

        return $activeModules;
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request): Response
    {
        $activeModules = $this->getActiveModules();

        // Ручная валидация
        $validator = Validator::make($request->all(), [
            'stars' => ['required', 'integer', 'between:1,5'],
            'modules_id' => ['nullable', 'exists:modules,id'],
            'message' => ['required', 'string', 'min:20'],
            'captcha' => ['required', 'string'],
        ], [
            'stars.required' => 'Поле оценки обязательно для заполнения.',
            'stars.between' => 'Оценка должна быть от 1 до 5',
            'message.required' => 'Поле сообщения обязательно для заполнения.',
            'message.min' => 'Сообщение должно содержать минимум 20 символов',
            'modules_id.exists' => 'Выбранный модуль не существует',
            'captcha.required' => 'Подтвердите, что вы не робот',
        ]);

        // Дополнительные проверки после валидации
        $validator->after(function ($validator) use ($request) {
            // Проверка авторизации
            if (!auth()->check()) {
                $validator->errors()->add('auth', 'Требуется авторизация для оставления отзыва');
            }

            // Проверка капчи
            if (!CaptchaService::check($request->input('captcha'))) {
                $validator->errors()->add('captcha', 'Неверный ответ на капчу. Попробуйте ещё раз.');
            }
        });

        // Если валидация не прошла - возвращаем форму с ошибками и новой капчей
        if ($validator->fails()) {
            // Генерируем новую капчу
            $captcha = CaptchaService::generate();

            return response()->view('partials.review-form', [
                'activeModules' => $activeModules,
                'errors' => $validator->errors()->messages(),
                'oldInput' => $request->only(['modules_id', 'stars', 'message']),
                'captcha' => $captcha,
            ])->setStatusCode(422);
        }

        $validated = $validator->validated();
        $this->reviewService->create([
            'user_id' => auth()->id(),
            'stars' => $validated['stars'],
            'modules_id' => $validated['modules_id'] ?? null,
            'message' => $validated['message'],
            'status' => Review::STATUS_NEW,
        ]);

        return response()->view('partials.review-form', [
            'activeModules' => $activeModules,
            'errors' => [],
            'oldInput' => [],
            'success' => true,
        ]);
    }

    /**
     * Обновление капчи (AJAX)
     */
    public function refreshCaptcha(): Response
    {
        $captcha = CaptchaService::generate();
        return response()->view('partials.captcha', [
            'captcha' => $captcha,
            'error' => null,
        ]);
    }
}
