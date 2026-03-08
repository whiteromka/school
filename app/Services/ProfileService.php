<?php

namespace App\Services;

use App\Models\Profile;
use App\Repositories\ProfileRepository;

class ProfileService
{
    public function __construct(
        protected ProfileRepository $profileRepository
    ) {}

    public function getProfileByUserId(int $userId): ?Profile
    {
        return $this->profileRepository->findByUserId($userId);
    }

    public function createProfile(array $data): Profile
    {
        return $this->profileRepository->create($data);
    }

    public function checkOrCreateProfile(array $data): Profile
    {
        $profile = $this->profileRepository->findByUserId($data['user_id']);
        return $profile ? $profile : $this->profileRepository->create($data);
    }

    public function updateProfile(int $id, array $data): bool
    {
        return $this->profileRepository->update($id, $data);
    }

    public function deleteProfile(int $id): bool
    {
        return $this->profileRepository->delete($id);
    }
}
