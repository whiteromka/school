<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20'],
            'telegram' => ['nullable', 'string', 'max:100'],
            'password' => $this->isMethod('POST') 
                ? ['required', 'min:6', 'confirmed'] 
                : ['nullable', 'min:6', 'confirmed'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'This email is already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Passwords do not match',
        ];
    }
}
