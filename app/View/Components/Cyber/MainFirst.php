<?php

namespace App\View\Components\Cyber;

use App\Helpers\IPFormatter;
use App\Models\ActiveModule;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use App\Services\ActiveModuleService;
use Illuminate\View\View;

class MainFirst extends Component
{
    public Collection|array $soonActiveModules = [];

    public string $userIp = '';

    public function __construct(
        protected ActiveModuleService $activeModulesService
    ) {
        $this->userIp = IPFormatter::format(request()->ip() ?? '127.0.0.1');

        // Получить все активные модули вместе с модулями и с количеством пользователей
        $this->soonActiveModules = $activeModulesService->getSoonActiveModules();
        //dd($this->soonActiveModules);
    }

    public function render(): View
    {
        return view('components.cyber.main-first');
    }
}
