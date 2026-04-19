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
     * @param int|null $lastId
     * @param string|null $type
     * @return Collection
     */
    public function getLatest(int $limit, ?int $lastId = null, ?string $type = null): Collection
    {
        $query = Vacancy::query()
            ->orderByDesc('id');

        if ($type) {
            $query->where('type', $type);
        }
        if ($lastId) {
            $query->where('id', '<', $lastId);
        }

        return $query->limit($limit)->get();
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
