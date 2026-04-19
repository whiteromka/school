<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use App\Services\HH\HHParserService;
use App\Services\HH\HHService;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class VacancyService
{
    private const int CACHE_HOURS = 12;

    public function __construct(
        private readonly VacancyRepository $vacancyRepository,
        //private readonly HHService $hhService // Старый вариант с АПИ hh.ru
        private readonly HHParserService $hhService
    ) {}

    public function getLatest(?int $lastId = null, int $limit = 6, ?string $type = null): Collection
    {
        return $this->vacancyRepository->getLatest($limit, $lastId, $type);
    }

    /**
     * Проверит нужно ли стянуть свежие вакансии с hh.ru, сохранит в БД, вернет коллекцию вакансий
     *
     * @param string $type PHP | Java Script
     * @return Collection
     */
    public function checkAndGetLatest(string $type): Collection
    {
        $cacheKey = 'cache_key_' . self::CACHE_HOURS . '_' . $type;

        if (!Cache::has($cacheKey)) {
            $lastCreatedAt = $this->vacancyRepository->getLastCreatedAt($type);
            if (!$lastCreatedAt) {
                $this->hhService->fetchVacancies($type);
                Cache::put($cacheKey, true, now()->addHours(self::CACHE_HOURS));
            } else {
                $lastCreatedAt = Carbon::parse($lastCreatedAt);
                // Если последняя вакансия из БД старше N часов
                if ($lastCreatedAt->lt(now()->subHours(self::CACHE_HOURS))) {
                    $this->hhService->fetchVacancies($type);
                    Cache::put($cacheKey, true, now()->addHours(self::CACHE_HOURS));
                }
            }
        }

        return $this->vacancyRepository->getLatest(6, 0, $type);
    }
}
