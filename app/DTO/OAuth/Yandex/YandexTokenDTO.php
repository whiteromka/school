<?php

namespace App\DTO\OAuth\Yandex;

use Illuminate\Support\Carbon;
use RuntimeException;

class YandexTokenDTO
{
    public function __construct(
        public readonly string $accessToken,
        public readonly ?string $refreshToken,
        public readonly Carbon $expiresAt,
        public readonly ?string $tokenType,
        public readonly ?string $scope,
        public readonly array $raw
    ) {}

    public static function fromArray(array $data): self
    {
        if (empty($data['access_token'])) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть access_token');
        }
        if (empty($data['refresh_token'])) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть refresh_token');
        }
        if (empty($data['expires_in'])) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть expires_in');
        }
        if (!is_numeric($data['expires_in'])) {
            throw new RuntimeException('Yandex Oauth сервис вернул expires_in не как numeric');
        }

        return new self(
            accessToken: $data['access_token'],
            refreshToken: $data['refresh_token'] ?? null,
            expiresAt: now()->addSeconds($data['expires_in']),
            tokenType: $data['token_type'] ?? null,
            scope: $data['scope'] ?? null,
            raw: $data
        );
    }
}
