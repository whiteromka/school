<?php

namespace App\Enums;

enum ModuleType: string
{
    case BACK = 'Back';
    case FRONT = 'Front';
    case ENG = 'Eng';
    case GAME = 'Game';

    /**
     * Получить все доступные типы модулей
     *
     * @return array
     */
    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
