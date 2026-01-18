<?php

namespace App\Services\OAuth;

use Illuminate\Support\Carbon;
use RuntimeException;

class OAuthTokensDTO
{
    public function __construct(
        public readonly string $accessToken,
        public readonly ?string $refreshToken,
        public readonly ?Carbon $expiresAt,
        public readonly ?Carbon $refreshTokenExpiresAt,
        public readonly ?string $tokenType,
        public readonly ?string $scope,
        public readonly array $raw
    ) {}

    /**
     * @param array $data Токены и их время жизни
     * @param string $serviceName Например: "Яндекс OAuth" или "Google OAuth"
     * @return self
     */
    public static function fromArray(array $data, string $serviceName = 'OAuth service'): self
    {
        if (empty($data['access_token'])) {
            throw new RuntimeException($serviceName . ' сервис не смог вернуть access_token');
        }

        $expiresIn = $data['expires_in'] ?? null;
        $expiresAt = is_numeric($expiresIn) ? now()->addSeconds((int)$expiresIn) : null;
        $refreshTokenExpiresIn = $data['refresh_token_expires_in'] ?? null;
        $refreshTokenExpiresAt = is_numeric($refreshTokenExpiresIn) ? now()->addSeconds((int)$refreshTokenExpiresIn) : null;

        return new self(
            accessToken: $data['access_token'],
            refreshToken: $data['refresh_token'] ?? null,
            expiresAt: $expiresAt,
            refreshTokenExpiresAt: $refreshTokenExpiresAt,
            tokenType: $data['token_type'] ?? null,
            scope: $data['scope'] ?? null,
            raw: $data
        );
    }
}
