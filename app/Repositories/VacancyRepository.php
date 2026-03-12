<?php

namespace App\Repositories;

use App\Models\Vacancy;
use Illuminate\Support\Collection;

class VacancyRepository
{
    public function getLatest(int $limit, int $offset = 0, ?string $type = null): Collection
    {
        $query = Vacancy::query()
            ->orderByDesc('published_at')
            ->orderByRaw('COALESCE(salary_to, salary_from, 0) DESC')
            ->offset($offset)
            ->limit($limit);

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get();
    }

    public function getLastPublishedAt(?string $type = null): ?string
    {
        $query = Vacancy::query()->latest('published_at');
        if ($type) {
            $query->where('type', $type);
        }
        return $query->value('published_at');
    }
}
