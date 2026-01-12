<?php

namespace App\Services\OAuth\Yandex;

use App\Models\OauthAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class YandexAuthService
{
    public function __construct(
        private readonly YandexOAuthClient $yaClient
    ) {}

    public function authenticate(string $code): void
    {
        $tokens = $this->yaClient->exchangeCodeForToken($code);
        $yandexUser = $this->yaClient->fetchUser($tokens->accessToken);

        $user = User::query()->firstOrCreate(
            ['email' => $yandexUser->email],
            [
                'name'      => $yandexUser->firstName,
                'last_name' => $yandexUser->lastName,
                'password'  => Hash::make(Str::random(32)),
            ]
        );

        OauthAccount::query()->updateOrCreate(
            [
                'provider'         => OauthAccount::YANDEX,
                'provider_user_id' => $yandexUser->id,
            ],
            [
                'user_id'       => $user->id,
                'access_token'  => $tokens->accessToken,
                'refresh_token' => $tokens->refreshToken,
                'expires_at'    => $tokens->expiresAt,
                'token_type'    => $tokens->tokenType,
                'scope'         => $tokens->scope,
                'raw_response'  => $tokens->raw, // ToDo collect($tokens->raw)->except(['access_token', 'refresh_token'])->toArray(),
            ]
        );

        Auth::login($user);
        request()->session()->regenerate();
    }
}
