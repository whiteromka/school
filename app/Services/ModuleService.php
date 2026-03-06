<?php

namespace App\Services;

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

    public function seedModules(array $modulesData): void
    {
        $this->moduleRepository->truncate();

        foreach ($modulesData as $moduleData) {
            $this->moduleRepository->create($moduleData);
        }
    }
}
