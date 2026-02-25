<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserUniqueEmailRule implements ValidationRule
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userByEmail = User::query()->where('email', $value)->first();
        $userById = User::query()->find($this->userId);
        if ($userByEmail) {
            if ($userById->id !== $userByEmail->id) {
                $fail("email уже занят.");
            }
        }
    }
}
