<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $attributes): User
    {
        return User::query()->create($attributes);
    }

    public function findOrCreateByEmail(string $email, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['email' => $email],
            $attributes
        );
    }

    /**
     * @param string $tgId Пример: 152365734
     * @param array $attributes
     * @return User
     */
    public function findOrCreateByTelegramId(string $tgId, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['telegram_id' => $tgId],
            $attributes
        );
    }

    /**
     * @param string $telegram Пример: @rom_1989
     * @param array $attributes
     * @return User
     */
    public function findOrCreateByTelegram(string $telegram, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['telegram' => $telegram],
            $attributes
        );
    }

    public function where(string $column, $value): ?User
    {
        return User::query()->where($column, $value)->first();
    }

    public function updateOnlyEmpty(User $user, array $attributes): void
    {
        if (empty($user->name) && !empty($attributes['name'])) {
            $user->name = $attributes['name'];
        }
        if (empty($user->last_name) && !empty($attributes['last_name'])) {
            $user->last_name = $attributes['last_name'];
        }
        if (empty($user->telegram) && !empty($attributes['telegram'])) {
            $user->telegram = $attributes['telegram'];
        }
        if (empty($user->telegram_id) && !empty($attributes['telegram_id'])) {
            $user->telegram_id = $attributes['telegram_id'];
        }
        $user->save();
    }
}
