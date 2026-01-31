<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 * docker compose exec app bash
 * php artisan telegram:set-webhook // переустановить хук
 * php artisan tinker
 * Http::get("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/getWebhookInfo")->json();
 */
class SetTelegramWebhook extends Command
{
    /** @var string Тестовый домен для работы с ТГ ботами на локалке */
    private string $testDomain = 'https://4bc6b92b0954b9e9-85-172-168-90.serveousercontent.com';

    protected $signature = 'telegram:set-webhook';
    protected $description = 'Установить вебхук для Telegram бота';

    public function handle()
    {
        $token = config('services.telegram.bot_token');
        $webhookUrl = $this->testDomain . '/tgbot/events';

        $response = Http::post("https://api.telegram.org/bot{$token}/setWebhook", ['url' => $webhookUrl]);
        if ($response->ok()) {
            $this->info("Вебхук установлен: {$webhookUrl}");
        } else {
            $this->error("Ошибка: " . json_encode($response->json()));
        }
    }
}
