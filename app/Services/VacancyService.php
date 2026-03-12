<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use App\Services\HH\HHService;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class VacancyService
{
    public function __construct(
        private readonly VacancyRepository $vacancyRepository,
        private readonly HHService $hhService
    ) {}

    public function getLatest(int $offset = 0, ?string $type = null): Collection
    {
        return $this->vacancyRepository->getLatest(6, $offset, $type);
    }

    /**
     * Проверит нужно ли стянуть свежие вакансии с hh.ru, сохранит в БД, вернет коллекцию вакансий
     *
     * @return Collection
     */
    public function checkAndGetLatest(?string $type = null): Collection
    {
        $cacheKey = 'vacancies_fresh_12h_' . ($type ?? 'all');

        if (!Cache::has($cacheKey)) {
            $lastCreatedAt = $this->vacancyRepository->getLastPublishedAt($type);
            if (!$lastCreatedAt) {
                $this->hhService->fetchVacancies();
                Cache::put($cacheKey, true, now()->addHours(12));
            } else {
                $lastCreatedAt = Carbon::parse($lastCreatedAt);
                // если последняя вакансия старше 12 часов
                if ($lastCreatedAt->lt(now()->subHours(12))) {
                    $this->hhService->fetchVacancies();
                    Cache::put($cacheKey, true, now()->addHours(12));
                }
            }
        }

        return $this->vacancyRepository->getLatest(6, 0, $type);
    }
}
