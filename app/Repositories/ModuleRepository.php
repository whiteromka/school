<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Collection;

class ModuleRepository
{
    public function getByType(string $type): Collection
    {
        return Module::query()
            ->where('type', $type)
            ->orderBy('number')
            ->get();
    }

    /**
     * Получить общий модуль для фронта и бека
     */
    public function getFirstCommonModule(): Module
    {
        return Module::query()
            ->where('number', 1)
            ->where('active', true)
            ->with(['openActiveModule.users'])
            ->first();
    }

    /**
     * Получить модули с активными модулями со статусом 'open' и пользователями
     */
    public function getModulesWithActiveModulesAndUsers(string $type): Collection
    {
        return Module::query()
            ->where('type', $type)
            ->where('active', true)
            ->with(['openActiveModule.users'])
            ->orderBy('number')
            ->get();
    }

    public function create(array $data): Module
    {
        return Module::query()->create($data);
    }

    public function truncate(): void
    {
        Module::query()->truncate();
    }
}
