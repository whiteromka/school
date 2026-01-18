<?php

namespace App\Services\OAuth\Github;

use App\Models\OauthAccount;
use App\Models\User;
use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GithubAuthService implements OAuthServiceInterface
{
    public function __construct(
        private readonly OAuthClientInterface $oauthClient
    ) {}

    public function authenticate(string $code): void
    {
        $oauthTokensDTO = $this->oauthClient->exchangeCodeForToken($code);
        $oauthUserDTO = $this->oauthClient->fetchUser($oauthTokensDTO->accessToken);

        $user = User::query()->firstOrCreate(
            ['email' => $oauthUserDTO->email],
            [
                'name'      => $oauthUserDTO->firstName,
                'last_name' => $oauthUserDTO->lastName,
                'password'  => Hash::make(Str::random(32)),
            ]
        );

        OauthAccount::query()->updateOrCreate(
            [
                'provider'         => OauthAccount::GITHUB,
                'provider_user_id' => $oauthUserDTO->id,
            ],
            [
                'user_id'       => $user->id,
                'access_token'  => $oauthTokensDTO->accessToken,
                'refresh_token' => $oauthTokensDTO->refreshToken,
                'expires_at'    => $oauthTokensDTO->expiresAt,
                'refresh_token_expires_at' => $oauthTokensDTO->refreshTokenExpiresAt,
                'token_type'    => $oauthTokensDTO->tokenType,
                'scope'         => $oauthTokensDTO->scope,
                'raw_response'  => $oauthTokensDTO->raw, // ToDo collect($tokens->raw)->except(['access_token', 'refresh_token'])->toArray(),
            ]
        );

        Auth::login($user);
        request()->session()->regenerate();
    }
}
