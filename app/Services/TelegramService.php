<?php

namespace App\Services;

use App\DTOs\TelegramUserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EmailGeneratorService $emailGeneratorService,
        private readonly PasswordGeneratorService $passwordGeneratorService
    )
    {}

    /**
     * Приветственное сообщение для пользователя написавшего тг боту
     */
    public function handleMessage(TelegramUserDTO $dto, ?string $text): void
    {
        if (!$dto->telegramId) {
            return;
        }

        $this->createOrUpdateUser($dto);
        $message = $this->buildWelcomeMessage($dto->getNameOrTelegram(), $dto->telegramId);

        $this->sendTo($dto->telegramId, $message);
    }

    /**
     * Отправить в общий чат
     */
    public function sendToCommonChat(string $text): void
    {
        $commonChatId = config('services.telegram.chat_id'); // ID общего чата куда добавили бота
        $this->sendTo($commonChatId, $text);
    }

    /**
     * Отправить сообщение в чат
     */
    public function sendTo(string $chatId, string $text): void
    {
        $token = config('services.telegram.bot_token');
        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (Exception $e) {
            Log::error('Error TelegramService::sendToUser(). ' . $e->getMessage());
        }
    }

    /**
     * @param TelegramUserDTO $dto
     * @return User
     */
    public function createOrUpdateUser(TelegramUserDTO $dto): User
    {
        $user = $this->userRepository->where('telegram', $dto->telegram);
        if (!$user) {
            $user = $this->userRepository->where('telegram_id', $dto->telegramId);
        }
        if ($user) {
            $this->userRepository->updateOnlyEmpty($user, $dto->toArray());
            return $user;
        }

        $attributes = $dto->toArray();
        $attributes['email'] = $this->emailGeneratorService->generateRandomEmail();
        $attributes['password'] = $this->passwordGeneratorService->generateRandomPassword();
        $attributes['from_tgbot_unknown'] = 1;

        return $this->userRepository->create($attributes);
    }

    /**
     * Формирует приветственное сообщение для пользователя.
     */
    private function buildWelcomeMessage(string $name, string $telegramId): string
    {
        $message = "Привет, {$name}!\n\n";
        $message .= "Ваш Telegram ID: <code>{$telegramId}</code>\n\n";
        $message .= "Я уведомлю вас, когда наберётся группа на курс, на который вы записаны, ";
        $message .= "а также когда откроется оплата.\n\n";
        $message .= "Спасибо за доверие!";

        return $message;
    }

    /**
     * Проверка достоверности данных при авторизации через ТГ
     *
     * @param array $data
     * @return bool
     */
    public function checkHash(array $data): bool
    {
        if (!isset($data['hash'], $data['auth_date'])) {
            return false;
        }
        if (time() - (int)$data['auth_date'] > 86400) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']);
        ksort($data);

        $dataCheckString = collect($data)
            ->map(fn ($v, $k) => $k . '=' . (string) $v)
            ->implode("\n");

        $secretKey = hash('sha256', config('services.telegram.bot_token'), true);
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        return hash_equals($calculatedHash, $hash);
    }
}
