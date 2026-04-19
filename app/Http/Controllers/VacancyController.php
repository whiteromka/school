<?php

namespace App\Http\Controllers;

use App\Services\VacancyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function __construct(
        private readonly VacancyService $vacancyService
    ) {}

    /**
     * GET /vacancy/check
     * Проверяет нужно ли подтянуть свежие вакансии с hh.ru.
     * Если нужно стянуть, то сохраняет их в БД.
     * Возвращает последние актуальные вакансии.
     */
    public function check(Request $request): JsonResponse
    {
        $type = $request->input('type'); // Java Script:
        $vacancies = $this->vacancyService->checkAndGetLatest($type);
        $html = view('vacancy._items', ['vacancies' => $vacancies])->render();

        return response()->json([
            'html' => $html,
            'count' => $vacancies->count(),
        ]);
    }

    /**
     * GET /vacancy/load-more
     */
    public function loadMore(Request $request): JsonResponse
    {
        $lastId = $request->input('last_id');
        $type = $request->input('type');
        $vacancies = $this->vacancyService->getLatest($lastId, 6, $type);

        return response()->json([
            'html' => view('vacancy._items', ['vacancies' => $vacancies])->render(),
            'count' => $vacancies->count(),
        ]);
    }
}
