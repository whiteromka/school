<?php

namespace App\Providers;

use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\YandexController;
use App\Services\OAuth\Github\GithubAuthService;
use App\Services\OAuth\Github\GithubOAuthClient;
use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthServiceInterface;
use App\Services\OAuth\Yandex\YandexAuthService;
use App\Services\OAuth\Yandex\YandexOAuthClient;
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
        //
    }
}
