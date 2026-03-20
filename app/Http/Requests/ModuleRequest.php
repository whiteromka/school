<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'type' => ['required', 'string', 'in:Back,Front,Eng'],
            'number' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'level' => ['required', 'integer', 'min:1'],
            'module_price' => ['required', 'integer', 'min:0'],
            'lesson_price' => ['required', 'integer', 'min:0'],
            'topics' => ['nullable', 'array'],
            'techs' => ['nullable', 'array'],
            'duration' => ['nullable', 'string', 'max:100'],
            'count_lessons' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'description2' => ['nullable', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'type.required' => 'Module type is required',
            'type.in' => 'Invalid module type',
            'name.required' => 'Module name is required',
            'name.min' => 'Module name must be at least 3 characters',
            'level.required' => 'Level is required',
            'level.min' => 'Level must be at least 1',
            'module_price.required' => 'Module price is required',
            'lesson_price.required' => 'Lesson price is required',
            'count_lessons.required' => 'Number of lessons is required',
            'author.required' => 'Author is required',
        ];
    }
}
