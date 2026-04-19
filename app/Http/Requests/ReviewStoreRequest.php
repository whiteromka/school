<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'stars' => ['required', 'integer', 'between:1,5'],
            'modules_id' => ['nullable', 'exists:modules,id'],
            'message' => ['required', 'string', 'min:20'],
            //'captcha' => ['required', 'string'],
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
            //'captcha.required' => 'Подтвердите, что вы не робот',
        ];
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Unauthenticated',
                'errors' => [
                    'auth' => ['Требуется авторизация']
                ]
            ], 401)
        );
    }
}
