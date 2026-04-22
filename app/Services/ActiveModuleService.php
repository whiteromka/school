<?php

namespace App\Services;

use App\Enums\ActiveModuleStatus;
use App\Models\ActiveModule;
use App\Models\User;
use App\Repositories\ActiveModuleRepository;
use Illuminate\Database\Eloquent\Collection;

class ActiveModuleService
{
    public function __construct(
        private readonly ActiveModuleRepository $activeModuleRepository
    ) {}

    /**
     * Получить список всех активных модулей.
     *
     * @return Collection<int, ActiveModule>
     */
    public function getAll(): Collection
    {
        return $this->activeModuleRepository->getAll();
    }

    /**
     * Получить активный модуль по его ID.
     *
     * @param int $id
     * @return ActiveModule|null
     */
    public function getById(int $id): ?ActiveModule
    {
        return $this->activeModuleRepository->getById($id);
    }

    /**
     * Получить активный модуль по ID модуля.
     *
     * @param int $moduleId
     * @return ActiveModule|null
     */
    public function getByModuleId(int $moduleId): ?ActiveModule
    {
        return $this->activeModuleRepository->getByModuleId($moduleId);
    }

    /**
     * Создать новый активный модуль.
     *
     * @param array $data
     * @return ActiveModule
     */
    public function create(array $data): ActiveModule
    {
        return $this->activeModuleRepository->create($data);
    }

    /**
     * Обновить активный модуль по ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->activeModuleRepository->update($id, $data);
    }

    /**
     * Удалить активный модуль по ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->activeModuleRepository->delete($id);
    }

    /**
     * Присоединить пользователя к активному модулю.
     *
     * Если активного модуля со статусом OPEN не существует — создаётся новый.
     * Если пользователь уже присоединён — повторное добавление не выполняется.
     *
     * @param User $user
     * @param int $moduleId
     * @return ActiveModule
     */
    public function joinUserToModule(User $user, int $moduleId): ActiveModule
    {
        // Ищем активный модуль со статусом STATUS_OPEN, если нт то создаем новый
        $activeModule = $this->activeModuleRepository->getByModuleIdAndStatus($moduleId, ActiveModuleStatus::OPEN->value);
        if (!$activeModule) {
            $activeModule = $this->activeModuleRepository->create([
                'module_id' => $moduleId,
                'status' => ActiveModuleStatus::OPEN->value,
            ]);
        }

        // Проверяем, присоединён ли уже пользователь
        if (!$activeModule->users()->where('user_id', $user->id)->exists()) {
            $activeModule->users()->attach($user->id, ['joined_at' => now()]);
        }
        return $activeModule;
    }

    /**
     * Отсоединить пользователя от активного модуля.
     *
     * @param User $user
     * @param int $moduleId
     * @return bool
     */
    public function leaveUserFromModule(User $user, int $moduleId): bool
    {
        $activeModule = $this->activeModuleRepository->getByModuleId($moduleId);
        $activeModule->users()->detach($user->id);
        return true;
    }

    /**
     * Получить список активных модулей пользователя в формате [id => name].
     *
     * @param User|null $user
     * @return array<int, string>
     */
    public function getUserActiveModules(User $user = null): array
    {
        if (!$user) {
            return [];
        }

        $user->load('activeModules.module');
        return $user->activeModules->pluck('module.name', 'module.id')->toArray();
    }

    /**
     * Вернет коллекцию самых популярных активных модулей каждого типа
     *
     * @return Collection
     */
    public function getSoonActiveModules(): Collection
    {
        return ActiveModule::query()
            ->with('module')
            ->withCount('users')
            ->where(['status' => ActiveModuleStatus::OPEN->value])
            //->orderBy('users_count', 'desc')
            ->get()
            ->sortByDesc('users_count')
            ->unique(fn ($m) => $m->module->type);
    }
}
