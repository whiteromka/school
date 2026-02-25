<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    public function create(array $params): bool
    {
        return $this->userRepository->createUser($params);
    }

    public function update(array $params, int $id): bool
    {
        return $this->userRepository->updateUser($params, $id);
    }

    public function getUsers(): Collection
    {
        return $this->userRepository->getUsers();
    }

    public function getFirstUser(): ?User
    {
        return $this->userRepository->getFirstUser();
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUsersEmails(int $numberOfEmails): Collection
    {
        return $this->userRepository->getUsersEmails($numberOfEmails);
    }
}
