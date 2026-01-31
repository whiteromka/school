<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TgbotController extends Controller
{
    public function __construct(
        private readonly TelegramService $telegramService
    ) {}

    /** url: http://localhost:8080/tgbot/events  */
    public function events(Request $request): JsonResponse
    {
        $data = $request->all();
        Log::info('Telegram webhook/events:', $data);
        // Обработка команды /start
        // if (isset($data['message']['text']) && str_starts_with($data['message']['text'], '/start')) {
        //    return $this->handleStartCommand($data);
        // }
        if (!empty($data['message']['text'])) {
            $this->telegramService->sayHello($data);
        }
        return response()->json(['ok' => true]); // ToDo что тут отвечать ?
    }
}
