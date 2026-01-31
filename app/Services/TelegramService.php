<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * Приветственное сообщение
     */
    public function sayHello(array $data): void
    {
        $userId = $data['message']['from']['id'] ?? null;
        $username = $data['message']['from']['username'] ?? null;
        $firstName = $data['message']['from']['first_name'] ?? '';
        $lastName = $data['message']['from']['last_name'] ?? '';

        // 1. Сохраняем в базу
        // ...->saveUser($userId, $username, $firstName, $lastName);

        // 2. Уведомляем себя (опционально)
        // ...->notifyAdmin($userId, $username);

        // 3. Отправляем ответ пользователю
        $name = $username ? "@{$username}" : $firstName;
        $message = "Привет, {$name}!\n\n";
        $message .= "Ваш Telegram ID: <code>{$userId}</code>\n\n";

        $message .= "Уведомлю Вас когда откроется оплата на курс на который Вы записаны!\n";
        $message .= "Используйте эти команды если хотите что бы я что-то уточнил: ...(это опционально не уверен что это нужно) \n\n";
        $message .= "ToDo: тут нужно еще подумать про сохранение данных пол-ля которые отсюда(из бота) прилетают.
        И когда придет время действительно уведомить пол-ля о том что оплата курса разблокирована, можно оплачивать.";

        $this->sendToUser($userId, $message);
    }

    /**
     * Отправить в общий чат
     */
    public function sendToCommonChat(string $text): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id'); // ID общего чата куда добавили бота
        // $chatId = config('services.telegram.my_id'); // мой ID

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (Exception $e) {
            Log::error('Error TelegramService::sendMessage(). ' . $e->getMessage());
        }
    }

    /**
     * Отправить конкретному пользователю
     */
    public function sendToUser(string $userId, string $text): void
    {
        $token = config('services.telegram.bot_token');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $userId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (Exception $e) {
            Log::error('Error TelegramService::sendToUser(). ' . $e->getMessage());
        }
    }
}
