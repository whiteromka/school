<?php

namespace App\Providers;

use App\Services\CaptchaService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Передаем данные в форму отзывов
        View::composer('components.nexus.reviews', function ($view) {
            $activeModules = [];

            if (auth()->check()) {
                $user = auth()->user();
                $user->load('activeModules.module');
                $activeModules = $user->activeModules->pluck('module.name', 'module.id')->toArray();
            }

            $view->with([
                'activeModules' => $activeModules,
                'captcha' => CaptchaService::generate(),
            ]);
        });
    }
}
