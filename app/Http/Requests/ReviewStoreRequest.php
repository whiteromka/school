<?php

namespace App\Http\Requests;

use App\Services\CaptchaService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class ReviewStoreRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
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
     *
     * @return array<string, string>
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

        // Создаем ViewErrorBag из ошибок валидатора
        $errorBag = new ViewErrorBag();
        $errorBag->put('default', new MessageBag($validator->errors()->messages()));

        // Формируем ответ в том же формате, что и контроллер
        throw new HttpResponseException(
            response()->view('partials.review-form', [
                'activeModules' => $activeModules,
                'errors' => $errorBag,
                'oldInput' => $this->only(['modules_id', 'stars', 'message', 'captcha']),
                'captcha' => $captcha,
            ])->setStatusCode(422)
        );
    }

    /**
     * Get the validated data from the request.
     *
     * @return array<string, mixed>
     */
    public function reviewData(): array
    {
        $validated = $this->validated();
        return [
            'stars' => $validated['stars'],
            'modules_id' => $validated['modules_id'] ?? null,
            'message' => $validated['message'],
        ];
    }
}
