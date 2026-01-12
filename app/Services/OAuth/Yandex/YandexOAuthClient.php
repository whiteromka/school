<?php

namespace App\Services\OAuth\Yandex;

use Illuminate\Support\Facades\Http;
use RuntimeException;
use App\DTO\OAuth\Yandex\YandexTokenDTO;
use App\DTO\OAuth\Yandex\YandexUserDTO;

class YandexOAuthClient
{
    public function exchangeCodeForToken(string $code): YandexTokenDTO
    {
        $response = Http::asForm()->post('https://oauth.yandex.ru/token', [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('services.yandex.client_id'),
            'client_secret' => config('services.yandex.client_secret'),
        ]);

        if ($response->failed()) {
            logger()->error('Yandex OAuth неудачный запрос токена', $response->json());
            throw new RuntimeException('Yandex OAuth неудачный запрос токена');
        }

        return YandexTokenDTO::fromArray($response->json());
    }

    public function fetchUser(string $accessToken): YandexUserDTO
    {
        $response = Http::withHeaders([
            'Authorization' => 'OAuth ' . $accessToken,
        ])->get('https://login.yandex.ru/info');

        if ($response->failed()) {
            logger()->error('Yandex OAuth неудачный запрос информации о пользователе', $response->json());
            throw new RuntimeException('Yandex OAuth неудачный запрос информации о пользователе');
        }

        return YandexUserDTO::fromArray($response->json());
    }
}
