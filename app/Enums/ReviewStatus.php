<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case NEW = 'new';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Новый',
            self::APPROVED => 'Одобрен',
            self::REJECTED => 'Отклонен',
        };
    }

    public static function map(): array
    {
        return [
            self::NEW->value => self::NEW->label(),
            self::APPROVED->value => self::APPROVED->label(),
            self::REJECTED->value => self::REJECTED->label(),
        ];
    }
}
