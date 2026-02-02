<?php

namespace App\DTOs;

class TelegramUserDTO
{
    public function __construct(
        public readonly ?string $telegramId,
        public readonly ?string $telegram,
        public readonly ?string $name,
        public readonly ?string $lastName,
    ) {}

    public function getNameOrTelegram(): string
    {
        return $this->telegram ? '@' . $this->telegram : $this->name;
    }

    public function toArray(): array
    {
        return [
            'telegram_id' => $this->telegramId,
            'telegram' => $this->telegram,
            'name' => $this->name,
            'last_name' => $this->lastName,
        ];
    }
}
