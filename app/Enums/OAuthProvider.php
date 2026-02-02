<?php

namespace App\Enums;

enum OAuthProvider: string
{
    case YANDEX = 'Yandex';
    case GITHUB = 'Github';
    case GOOGLE = 'Google';
    case TELEGRAM = 'Telegram';

    public static function verifiedEmailProviders(): array
    {
        return [self::YANDEX, self::GITHUB, self::GOOGLE];
    }
}
