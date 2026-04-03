<?php

namespace App\Http\Controllers;

use App\Enums\ModuleType;
use App\Helpers\IPFormatter;
use App\Http\Requests\VacancyFilterRequest;
use App\Models\Vacancy;
use App\Services\ModuleService;

class SiteController extends Controller
{
    public function __construct(
        private readonly ModuleService $moduleService
    ) {}

    // GET /
    public function index()
    {
        $userIp = IPFormatter::format(request()->ip() ?? '127.0.0.1');

        return view('site.index', [
            'userIp' => $userIp,
        ]);
    }

    // GET /site/front
    public function front()
    {
        $user = auth()->user();
        $userModuleIds = [];
        if ($user) {
            $user->load('activeModules');
            $userModuleIds = $user->activeModules->pluck('module_id')->toArray();
        }

        $firstModule = $this->moduleService->getFirstCommonModule();
        $frontModules = $this->moduleService->getModulesWithActiveModulesAndUsers(ModuleType::FRONT->value);
        $frontModules = $frontModules->prepend($firstModule);

        return view('site.front', [
            'modules' => $frontModules,
            'userModuleIds' => $userModuleIds,
        ]);
    }

    // GET /site/back
    public function back()
    {
        $user = auth()->user();
        $userModuleIds = [];
        if ($user) {
            $user->load('activeModules');
            $userModuleIds = $user->activeModules->pluck('module_id')->toArray();
        }

        return view('site.back', [
            'modules' => $this->moduleService->getModulesWithActiveModulesAndUsers(ModuleType::BACK->value),
            'userModuleIds' => $userModuleIds,
        ]);
    }

    // GET /site/gamedev
    public function gamedev()
    {
        return view('site.gamedev');
    }

    // GET /site/english
    public function english(VacancyFilterRequest $request)
    {
        $data = $request->validated();
        $query = Vacancy::query();

        if (!empty($data['type'])) {
            $query->where('type', $data['type']);
        }
        if (!empty($data['name'])) {
            $query->where('name', 'like', "%{$data['name']}%");
        }
        if (!empty($data['salary_from'])) {
            $query->where('salary_from', '>=', $data['salary_from']);
        }
        if (!empty($data['salary_to'])) {
            $query->where('salary_to', '<=', $data['salary_to']);
        }

        $vacancies = $query
            ->orderBy('salary_from', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('site.english', [
            'vacancies' => $vacancies,
            'filters' => $data,
        ]);
    }
}
