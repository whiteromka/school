<?php

namespace App\Http\Controllers;

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
        return view('site.front');
    }

    // GET /site/back
    public function back()
    {
        return view('site.back', [
            'modules' => $this->moduleService->getBackModules(),
        ]);
    }

    // GET /site/gamedev
    public function gamedev()
    {
        return view('site.gamedev');
    }
}
