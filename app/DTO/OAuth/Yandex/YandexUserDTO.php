<?php

namespace App\DTO\OAuth\Yandex;

use RuntimeException;

class YandexUserDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $firstName,
        public readonly ?string $lastName,
        public readonly array $raw
    )
    {}

    public static function fromArray(array $data): self
    {
        $email = strtolower($data['default_email'] ?? $data['emails'][0] ?? '');
        if (!$email) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть email пользователя');
        }
        if (empty($data['id'])) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть id пользователя');
        }
        if (empty($data['first_name'])) {
            throw new RuntimeException('Yandex Oauth сервис не смог вернуть first_name пользователя');
        }

        return new self(
            id: (string)$data['id'],
            email: $email,
            firstName: $data['first_name'],
            lastName: $data['last_name'] ?? null,
            raw: $data
        );
    }
}
