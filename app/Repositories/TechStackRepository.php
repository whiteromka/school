<?php

namespace App\Repositories;

use App\Models\TechStack;

class TechStackRepository
{
    public function create(array $data): TechStack
    {
        return TechStack::query()->create($data);
    }

    public function truncate(): void
    {
        TechStack::query()->truncate();
    }

    public function getById(int $id): TechStack
    {
        return TechStack::query()->findOrFail($id);
    }
}
