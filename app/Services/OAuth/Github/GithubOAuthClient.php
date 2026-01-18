<?php

namespace App\Services\OAuth\Github;

use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthTokensDTO;
use App\Services\OAuth\OAuthUserDTO;
use Illuminate\Support\Facades\Http;

class GithubOAuthClient implements OAuthClientInterface
{
    /**
     * Отправляем код и данные приложения в github для получения токенов
     */
    public function exchangeCodeForToken(string $code): OAuthTokensDTO
    {
        $response = Http::asForm()
            ->withHeaders(['Accept' => 'application/json'])
            ->timeout(30)
            ->retry(3, 1000)
            ->post('https://github.com/login/oauth/access_token', [
                'code'          => $code,
                'redirect_uri'  => config('services.github.redirect_uri'),
                'client_id'     => config('services.github.client_id'),
                'client_secret' => config('services.github.client_secret'),
            ]);

        if ($response->failed()) {
            logger()->error('Github OAuth ошибка сервиса', $response->json());
            abort(500, 'Github OAuth ошибка сервиса');
        }

        return OAuthTokensDTO::fromArray($response->json(), 'Github OAuth');
    }

    public function fetchUser(string $accessToken): OAuthUserDTO
    {
        $email = $this->fetchUserEmail($accessToken);
        $userData = $this->fetchDataUser($accessToken);

        return new OAuthUserDTO(
            $userData['id'],
            $email,
            $userData['name'],
            null,
            $userData['raw']
        );
    }

    /**
     * Отправляем access_token в github, что бы получить email поль-ля.
     */
    private function fetchUserEmail(string $accessToken): string
    {
        $response = Http::withToken($accessToken)
            ->withHeaders([
                'Accept'     => 'application/vnd.github+json',
                'User-Agent' => 'Laravel-App',
            ])
            ->timeout(30)
            ->retry(3, 1000)
            ->get('https://api.github.com/user/emails');

        if ($response->failed()) {
            logger()->error('Github OAuth не смог вернуть email пользователя', $response->json());
            abort(500, 'Github OAuth не смог вернуть email пользователя');
        }

        $emails = $response->json();
        $email = collect($emails)->firstWhere('primary', true)['email'] ?? null;
        if (!$email) {
            logger()->error('Не смогли получить email пользователя', $response->json());
            abort(500, 'Не смогли получить email пользователя');
        }

        return $email;
    }

    /**
     * Запрашиваем остальные данные о пользователе
     */
    private function fetchDataUser(string $accessToken): array
    {
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])
            ->timeout(30)
            ->retry(3, 1000)
            ->get('https://api.github.com/user');

        if ($userResponse->failed()) {
            logger()->error('Github Oauth не получилось получить данные о пол-ле', $userResponse->json());
            abort(500, 'Github Oauth не получилось получить данные о пол-ле');
        }
        $githubUser = $userResponse->json();

        return [
            'id' => $githubUser['id'],
            'name' => $githubUser['name'] ?? $githubUser['login'],
            'raw' => $githubUser
        ];
    }
}
