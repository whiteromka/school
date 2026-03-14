<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ModuleService $moduleService
    ) {}

    /**
     * Получить активные модули пользователя
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
        ], [
            'stars.required' => 'Поле оценки обязательно для заполнения.',
            'stars.between' => 'Оценка должна быть от 1 до 5',
            'message.required' => 'Поле сообщения обязательно для заполнения.',
            'message.min' => 'Сообщение должно содержать минимум 20 символов',
            'modules_id.exists' => 'Выбранный модуль не существует',
        ]);

        // Проверка авторизации
        if (!auth()->check()) {
            $validator->errors()->add('auth', 'Требуется авторизация для оставления отзыва');
        }

        // Если валидация не прошла - возвращаем форму с ошибками
        if ($validator->fails()) {
            return response()->view('partials.review-form', [
                'activeModules' => $activeModules,
                'errors' => $validator->errors()->messages(),
                'oldInput' => $request->only(['modules_id', 'stars', 'message']),
            ])->setStatusCode(422);
        }

        $validated = $validator->validated();
        Review::query()->create([
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
}
