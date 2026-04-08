<?php

namespace App\Services;

use App\Models\Module;
use App\Repositories\ModuleRepository;
use Illuminate\Support\Collection;

class ModuleService
{
    public function __construct(
        private readonly ModuleRepository $moduleRepository
    ) {}

    public function getBackModules(): Collection
    {
        return $this->moduleRepository->getByType('back');
    }

    public function getFirstCommonModule(): Module
    {
        return $this->moduleRepository->getFirstCommonModule();
    }

    /**
     * Получить коллекцию модулей со связью с активными со связью с записавшимися пользователями
     */
    public function getModulesWithActiveModulesAndUsers(string $type): Collection
    {
        return $this->moduleRepository->getModulesWithActiveModulesAndUsers($type);
    }

    /**
     * Транкейтнуть modules и записать дефолтные данные
     */
    public function seedModules(array $modulesData): void
    {
        $this->moduleRepository->truncate();
        foreach ($modulesData as $moduleData) {
            $this->moduleRepository->create($moduleData);
        }
    }
}
