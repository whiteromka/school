<?php

namespace App\Services;

use App\Models\ActiveModule;
use App\Models\User;
use App\Repositories\ActiveModuleRepository;
use Illuminate\Database\Eloquent\Collection;

class ActiveModuleService
{
    public function __construct(
        private readonly ActiveModuleRepository $activeModuleRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->activeModuleRepository->getAll();
    }

    public function getById(int $id): ?ActiveModule
    {
        return $this->activeModuleRepository->getById($id);
    }

    public function getByModuleId(int $moduleId): ?ActiveModule
    {
        return $this->activeModuleRepository->getByModuleId($moduleId);
    }

    public function create(array $data): ActiveModule
    {
        return $this->activeModuleRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->activeModuleRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->activeModuleRepository->delete($id);
    }

    public function joinUserToModule(User $user, int $moduleId): ActiveModule
    {
        // Ищем активный модуль со статусом STATUS_OPEN
        $activeModule = $this->activeModuleRepository->getByModuleIdAndStatus($moduleId, ActiveModule::STATUS_OPEN);
        if (!$activeModule) {
            $activeModule = $this->activeModuleRepository->create([
                'module_id' => $moduleId,
                'status' => ActiveModule::STATUS_OPEN,
            ]);
        }

        // Проверяем, присоединён ли уже пользователь
        if (!$activeModule->users()->where('user_id', $user->id)->exists()) {
            $activeModule->users()->attach($user->id, ['joined_at' => now()]);
        }

        return $activeModule;
    }

    public function leaveUserFromModule(User $user, int $moduleId): bool
    {
        $activeModule = $this->activeModuleRepository->getByModuleId($moduleId);
        $activeModule->users()->detach($user->id);
        return true;
    }

    /**
     * Получить активные модули пользователя [id => name]
     */
    public function getUserActiveModules(User $user): array
    {
        $user->load('activeModules.module');
        return $user->activeModules->pluck('module.name', 'module.id')->toArray();
    }
}
