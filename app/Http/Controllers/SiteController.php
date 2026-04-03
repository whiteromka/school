<?php

namespace App\Http\Controllers;

use App\Enums\ModuleType;
use App\Helpers\IPFormatter;
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
    public function english()
    {
        return view('site.english');
    }
}
