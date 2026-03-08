<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->user();

        return [
            // User fields
            'name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'telegram' => ['nullable', 'string', 'max:100'],
            'username' => ['nullable', 'string', 'max:100'],

            // Profile fields
            'gender' => ['nullable', 'in:male,female,other'],
            'birthday' => ['nullable', 'date'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'industry' => ['nullable', 'string', 'max:100'],
            'job' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'integer', 'min:0', 'max:10'],
            'obout' => ['nullable', 'string', 'max:1000'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:50'],
            'github' => ['nullable', 'url', 'max:255'],
            'is_free_offer' => ['nullable', 'boolean'],
            'is_money_offer' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get validated user data.
     *
     * @return array<string, mixed>
     */
    public function userData(): array
    {
        return $this->only([
            'name',
            'last_name',
            'email',
            'phone',
            'telegram',
            'username',
        ]);
    }

    /**
     * Get validated profile data.
     *
     * @return array<string, mixed>
     */
    public function profileData(): array
    {
        return $this->only([
            'gender',
            'birthday',
            'country',
            'city',
            'industry',
            'job',
            'level',
            'obout',
            'years_experience',
            'github',
            'is_free_offer',
            'is_money_offer',
        ]);
    }
}
