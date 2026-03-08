<?php

namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository
{
    public function __construct(
        protected Profile $profile
    ) {}

    public function all(): Collection
    {
        return $this->profile->all();
    }

    public function find(int $id): ?Profile
    {
        return $this->profile->find($id);
    }

    public function findByUserId(int $userId): ?Profile
    {
        return $this->profile->where('user_id', $userId)->first();
    }

    public function create(array $data): Profile
    {
        return $this->profile->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $profile = $this->find($id);
        return $profile ? $profile->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $profile = $this->find($id);
        return $profile ? $profile->delete() : false;
    }
}
