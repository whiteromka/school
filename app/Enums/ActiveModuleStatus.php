<?php

namespace App\Enums;

enum ActiveModuleStatus: string
{
    case OPEN = 'open';
    case STARTED_FREE = 'started_free';
    case CAN_PAY = 'can_pay';
    case STARTED_FULL = 'started_full';
    case FINISHED = 'finished';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Запись открыта',
            self::STARTED_FREE => 'Идут бесплатные уроки',
            self::CAN_PAY => 'Можно оплачивать',
            self::STARTED_FULL => 'Запись закрыта',
            self::FINISHED => 'Завершен',
        };
    }

    public static function map(): array
    {
        return [
            self::OPEN->value => self::OPEN->label(),
            self::STARTED_FREE->value => self::STARTED_FREE->label(),
            self::CAN_PAY->value => self::CAN_PAY->label(),
            self::STARTED_FULL->value => self::STARTED_FULL->label(),
            self::FINISHED->value => self::FINISHED->label(),
        ];
    }

    /**
     * Статусы, которые должны быть уникальны в пределах одного module_id
     */
    public static function uniqueStatuses(): array
    {
        return [
            self::OPEN,
            self::STARTED_FREE,
            self::STARTED_FULL,
        ];
    }
}
