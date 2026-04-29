<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class SlackLog
{
    public const OAUTH_YANDEX = "OAuth Yandex";
    public const OAUTH_GOOGLE = "OAuth Google";
    public const OAUTH_GITHUB = "OAuth Github";

    /**
     * @param Throwable $e
     * @return void
     */
    public static function log(Throwable $e, string $message = ""): void
    {
        try {
            $text = $message . ". Ошибка: " . $e->getMessage() . " код: " . $e->getCode() . " файл: " . $e->getFile() . " строка: " . $e->getLine();
            $url = config('services.slack.school_errors_chat');
            Http::post($url, ['text' => $text]);
        } catch (Throwable $e) {
            Log::error($message);
        }
    }
}
