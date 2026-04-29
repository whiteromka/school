<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Services\OAuth\Google\GoogleAuthService;
use App\Services\SlackLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function __construct(
        private readonly GoogleAuthService $googleAuthService
    ) {}

    /**
     * Перенаправление на Google для авторизации
     */
    public function login(): Redirector|RedirectResponse
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Throwable $e) {
            SlackLog::log($e, SlackLog::OAUTH_GOOGLE);
            return redirect('/login')->with('error', 'Ошибка авторизации через ' . SlackLog::OAUTH_GOOGLE);
        }
    }

    /**
     * Страница на которую редиректит google
     * Обработка callback от Google
     */
    public function verificationCode(): Redirector|RedirectResponse
    {
        try {
            /** @var \Laravel\Socialite\Two\User $socialiteUser */
            $socialiteUser = Socialite::driver('google')->user();
            $this->googleAuthService->authenticate($socialiteUser);

            return redirect('/profile')->with('success', 'Вы успешно авторизовались через ' . SlackLog::OAUTH_GOOGLE);
        } catch (Throwable $e) {
            SlackLog::log($e, SlackLog::OAUTH_GOOGLE);
            return redirect('/login')->with('error', 'Ошибка авторизации через ' . SlackLog::OAUTH_GOOGLE);
        }
    }
}
