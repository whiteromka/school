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

    public function create(array $data): Module
    {
        return Module::query()->create($data);
    }

    public function truncate(): void
    {
        Module::query()->truncate();
    }
}
