<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        /** @var User $user */
//        $user = auth()->user();
//        return $user->is_admin;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string'],
            'name' => ['nullable', 'string', 'min:2', 'max:255'],
            'salary_from' => ['nullable', 'integer'],
            'salary_to' => ['nullable', 'integer']
        ];
    }
}
