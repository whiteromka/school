<?php

namespace App\Repositories;

use App\Models\Vacancy;
use Illuminate\Support\Collection;

class VacancyRepository
{
    /**
     * Получить последние вакансии
     *
     * @param int $limit
     * @param int $offset
     * @param string|null $type
     * @return Collection
     */
    public function getLatest(int $limit, int $offset = 0, ?string $type = null): Collection
    {
        $query = Vacancy::query()
            ->orderByDesc('created_at')
            //->orderByRaw('COALESCE(salary_to, salary_from, 0) DESC')
            ->offset($offset)
            ->limit($limit);

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get();
    }

    /**
     * Получить последнюю дату создания вакансии с типом = ...
     *
     * @param string|null $type
     * @return string|null
     */
    public function getLastCreatedAt(?string $type = null): ?string
    {
        $query = Vacancy::query()->latest('created_at');
        if ($type) {
            $query->where('type', $type);
        }
        return $query->value('created_at');
    }
}
