<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class RandomUserCreatorService
{
    public function createUsers(int $numberOfUsers): int
    {
        $createdUsersNumber = 0;
        for ($i = 0; $i < $numberOfUsers; $i++) {
            $user = $this->createRandomUser();
            $createdUsersNumber += (int)$user->save();
        }
        return $createdUsersNumber;
    }

    public function generateRandomEmail(): string
    {
        return Str::random(8) . '@mail.com';
    }

    public function createRandomUser(): User
    {
        $user = new User();
        $user->name = 'John';
        $user->last_name = 'Doe';
        $user->email = $this->generateRandomEmail();
        $user->password = '123';

        return $user;
    }

    public function updateUser(int $id): User
    {
        $user = User::query()->where('id', $id)->first();
        $user->name = Str::random(8);
        $user->last_name = Str::random(10);
        $user->email = Str::random(8) . '@mail.com';

        return $user;
    }

}
