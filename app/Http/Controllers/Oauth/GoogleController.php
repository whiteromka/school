<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Services\OAuth\Google\GoogleAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;

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
        return Socialite::driver('google')->redirect();
    }

    /**
     * Обработка callback от Google
     */
    public function verificationCode(): Redirector|RedirectResponse
    {
        /** @var \Laravel\Socialite\Two\User $socialiteUser */
        $socialiteUser = Socialite::driver('google')->user();
        $this->googleAuthService->authenticate($socialiteUser);

        return redirect('/')->with('success', 'Ура! Вы успешно зарегистрировались и вошли в систему');
    }
}
