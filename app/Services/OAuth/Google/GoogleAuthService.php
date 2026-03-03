<?php

namespace App\Services\OAuth\Google;

use App\Enums\OAuthProvider;
use App\Services\OAuth\OAuthUserDTO;
use App\Services\OauthAccountService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\User;

class GoogleAuthService
{
    public function __construct(
        private readonly UserService $userService,
        private readonly OauthAccountService $oauthAccountService,
    ) {}

    public function authenticate(User $googleUser): void
    {
        $nameParts = explode(' ', $googleUser->getName());
        $name = $nameParts[0];
        $lastName = $nameParts[1] ?? null;
        $googleId = $googleUser->getId();

        $data = [
            'id' => $googleId,
            'email' => $googleUser->getEmail(),
            'name' => $name,
            'last_name' => $lastName,
        ];
        $oauthUserDTO = OAuthUserDTO::fromArray($data, OAuthProvider::GOOGLE->value);
        $user = $this->userService->findOrCreateByEmail($oauthUserDTO);

        $expiresIn = $googleUser->expiresIn ?? null;
        $expiresAt = is_numeric($expiresIn) ? now()->addSeconds((int)$expiresIn) : null;
        $attributes['user_id'] = $user->id;
        $attributes['access_token'] = $googleUser->token;
        $attributes['refresh_token'] = $googleUser->refreshToken;
        $attributes['expires_at'] = $expiresAt;

        $this->oauthAccountService->updateOrCreate(
            OAuthProvider::GOOGLE->value,
            $oauthUserDTO->id,
            $attributes
        );

        Auth::login($user, true);
    }
}
