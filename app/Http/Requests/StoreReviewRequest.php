<?php

namespace App\Http\Requests;

use App\Services\CaptchaService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'stars' => ['required', 'integer', 'between:1,5'],
            'modules_id' => ['nullable', 'exists:modules,id'],
            'message' => ['required', 'string', 'min:20'],
            'captcha' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'stars.required' => 'Поле оценки обязательно для заполнения.',
            'stars.between' => 'Оценка должна быть от 1 до 5',
            'message.required' => 'Поле сообщения обязательно для заполнения.',
            'message.min' => 'Сообщение должно содержать минимум 20 символов',
            'modules_id.exists' => 'Выбранный модуль не существует',
            'captcha.required' => 'Подтвердите, что вы не робот',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            // Проверка авторизации
            if (!auth()->check()) {
                $validator->errors()->add('auth', 'Требуется авторизация для оставления отзыва');
            }

            // Проверка капчи
            if (!CaptchaService::check($this->input('captcha'))) {
                $validator->errors()->add('captcha', 'Неверный ответ на капчу. Попробуйте ещё раз.');
            }
        });
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        // Генерируем новую капчу для отображения
        $captcha = CaptchaService::generate();

        // Получаем активные модули (аналогично контроллеру)
        $activeModules = [];
        $user = auth()->user();
        if ($user) {
            $user->load('activeModules.module');
            $activeModules = $user->activeModules->pluck('module.name', 'module.id')->toArray();
        }

        // Формируем ответ в том же формате, что и контроллер
        throw new HttpResponseException(
            response()->view('partials.review-form', [
                'activeModules' => $activeModules,
                'errors' => $validator->errors()->messages(),
                'oldInput' => $this->only(['modules_id', 'stars', 'message']),
                'captcha' => $captcha,
            ])->setStatusCode(422)
        );
    }

    /**
     * Get prepared data for review creation.
     */
    public function reviewData(): array
    {
        return [
            'stars' => $this->validated('stars'),
            'modules_id' => $this->validated('modules_id') ?? null,
            'message' => $this->validated('message'),
        ];
    }
}
