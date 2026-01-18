<?php

namespace App\Services\OAuth;

use RuntimeException;

class OAuthUserDTO
{
    public function __construct(
        public string $id,
        public string $email,
        public string $firstName,
        public ?string $lastName,
        public array $raw
    )
    {}

    public static function fromArray(array $data, string $serviceName = 'OAuth service'): self
    {
        $email = strtolower($data['email'] ?? $data['default_email'] ?? $data['emails'][0] ?? '');
        if (!$email) {
            throw new RuntimeException("$serviceName не смог вернуть email пользователя");
        }
        if (empty($data['id'])) {
            throw new RuntimeException("$serviceName не смог вернуть id пользователя");
        }
        $name = $data['first_name'] ?? $data['name'] ?? null;
        if (!$name) {
            throw new RuntimeException("$serviceName не смог вернуть first_name пользователя");
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
