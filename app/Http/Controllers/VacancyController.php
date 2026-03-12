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
        $type = $request->get('type');
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
        $offset = (int)$request->get('offset', 0);
        $type = $request->get('type');
        $vacancies = $this->vacancyService->getLatest($offset, $type);
        $html = view('vacancy._items', ['vacancies' => $vacancies])->render();

        return response()->json([
            'html' => $html,
            'count' => $vacancies->count(),
        ]);
    }
}
