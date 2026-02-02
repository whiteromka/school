<?php

namespace App\Http\Controllers;

use App\DTOs\TelegramUserDTO;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramAuthController extends Controller
{
    public function __construct(
        private readonly TelegramService $telegramService,
    ) {}

    // ToDo на локалке не получилось протестить
    // /telegram-auth/auth
    // [
    //    "id"         => "123456789",        // Telegram user ID (ОБЯЗАТЕЛЬНО)
    //    "first_name" => "Ivan",
    //    "last_name"  => "Ivanov",            // может не быть
    //    "username"   => "ivanov",            // может не быть
    //    "auth_date"  => "1706700000",         // unix timestamp
    //    "hash"       => "a8f4c3e9..."         // КРИПТО-подпись (ОБЯЗАТЕЛЬНО)
    //]
    public function auth(Request $request)
    {
        $data = $request->all();
        if (!$this->telegramService->checkHash($data)) {
            abort(403, 'Telegram auth failed');
        }

        $user = $this->telegramService->createOrUpdateUser(
            new TelegramUserDTO(
                telegramId: $request->get('id', ''),
                telegram: $request->get('username', ''),
                name: $request->get('first_name', ''),
                lastName: $request->get('last_name', '')
            )
        );

        Auth::login($user, true);
        return redirect()->route('user.lk');
    }

}
