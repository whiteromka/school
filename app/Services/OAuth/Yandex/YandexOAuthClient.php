<?php

namespace App\Services\OAuth\Yandex;

use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthTokensDTO;
use App\Services\OAuth\OAuthUserDTO;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class YandexOAuthClient implements OAuthClientInterface
{
    public function exchangeCodeForToken(string $code): OAuthTokensDTO
    {
        $response = Http::asForm()
            ->withHeaders(['Accept' => 'application/json'])
            ->timeout(30)
            ->retry(3, 1000)
            ->post('https://oauth.yandex.ru/token', [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('services.yandex.client_id'),
            'client_secret' => config('services.yandex.client_secret'),
        ]);

        if ($response->failed()) {
            logger()->error('Yandex OAuth неудачный запрос токена', $response->json());
            throw new RuntimeException('Yandex OAuth неудачный запрос токена');
        }

        return OAuthTokensDTO::fromArray($response->json(),'Yandex OAuth');
    }

    public function fetchUser(string $accessToken): OAuthUserDTO
    {
        $response = Http::withHeaders([
            'Authorization' => 'OAuth ' . $accessToken,
        ])
        ->timeout(30)
        ->retry(3, 1000)
        ->get('https://login.yandex.ru/info');

        if ($response->failed()) {
            logger()->error('Yandex OAuth неудачный запрос информации о пользователе', $response->json());
            throw new RuntimeException('Yandex OAuth неудачный запрос информации о пользователе');
        }

        return OAuthUserDTO::fromArray($response->json());
    }
}
