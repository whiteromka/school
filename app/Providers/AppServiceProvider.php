<?php

namespace App\Providers;

use App\Helpers\IPFormatter;
use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\YandexController;
use App\Models\Vacancy;
use App\Services\OAuth\Github\GithubAuthService;
use App\Services\OAuth\Github\GithubOAuthClient;
use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthServiceInterface;
use App\Services\OAuth\Yandex\YandexAuthService;
use App\Services\OAuth\Yandex\YandexOAuthClient;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Github OAuth
        $this->app->when(GithubController::class)
            ->needs(OAuthServiceInterface::class)
            ->give(GithubAuthService::class);

        $this->app->when(GithubAuthService::class)
            ->needs(OAuthClientInterface::class)
            ->give(GithubOAuthClient::class);

        // Yandex OAuth
        $this->app->when(YandexController::class)
            ->needs(OAuthServiceInterface::class)
            ->give(YandexAuthService::class);

        $this->app->when(YandexAuthService::class)
            ->needs(OAuthClientInterface::class)
            ->give(YandexOAuthClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        if (app()->environment('production')) {
//            URL::forceScheme('https');
//        }

        $vacancies = Vacancy::query()
            ->whereDate('created_at', '2026-02-14')
            ->where(function($query) {
                $query->whereNotNull('salary_to')
                    ->orWhereNotNull('salary_from');
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        $vacancies = $vacancies->all();


        $userIp = $_SERVER['REMOTE_ADDR'] ?? '127.01.0.1';
        $userIp = IPFormatter::format($userIp);
        View::share('userIp', $userIp);
        View::share('vacancies', $vacancies);
    }
}
