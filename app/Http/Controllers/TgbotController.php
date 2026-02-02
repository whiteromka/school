<?php

namespace App\Http\Controllers;

use App\DTOs\TelegramUserDTO;
use App\Http\Requests\TelegramWebhookRequest;
use App\Services\TelegramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TgbotController extends Controller
{
    public function __construct(
        private readonly TelegramService $telegramService
    ) {}

    /** url: http://localhost:8080/tgbot/events  */
    public function events(TelegramWebhookRequest $request): JsonResponse
    {
        Log::info('Telegram webhook/events', $request->all());

        $this->telegramService->handleMessage(
            new TelegramUserDTO(
                telegramId: $request->telegramId(),
                telegram: $request->telegram(),
                name: $request->name(),
                lastName: $request->lastName(),
            ),
            $request->text()
        );

        return response()->json(['ok' => true]);
    }
}
