<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\OauthAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class YandexController extends Controller
{
    /**
     * /yandex/verification-code
     * route: http://localhost:8080/yandex/verification-code?code=some_code&cid=xxx
     */
    public function verificationCode(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            abort(400, 'Authorization code not found');
        }
        $response = Http::asForm()->post('https://oauth.yandex.ru/token', [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('services.yandex.client_id'),
            'client_secret' => config('services.yandex.client_secret'),
        ]);

        if ($response->failed()) {
            logger()->error('Yandex OAuth error', $response->json()); // [2026-01-09 21:15:17] local.ERROR: Yandex OAuth error {"error":"invalid_grant","error_description":"Code has expired"}
            abort(500, 'Yandex OAuth failed');
        }

        $data = $response->json();
        // $data =
        // {
        //     "access_token": "aaa",
        //     "expires_in": 31536000,
        //     $expiresAt = now()->addSeconds(31536000); // 1 год //
        //     "refresh_token": "bbb",
        //     "token_type": "bearer"
        // }

        // тут ошибка! тут нужно сначала запросить данные у яндекса по токену, потом сохранить user-а в таблицу то что яндекс отдаст, потом авторизовать пользователя.
        // И только потом все остальное.
        $user = Auth::user(); // текущий авторизованный пользователь
        if (!$user) {
            abort(401, 'User not authenticated');
        }

        // Рассчитываем дату истечения токена
        $expiresAt = isset($data['expires_in'])
            ? Carbon::now()->addSeconds($data['expires_in'])
            : null;

        // Сохраняем или обновляем запись
        OauthAccount::updateOrCreate(
            [
                'provider'          => 'yandex',
                'provider_user_id'  => $user->id, // или другой уникальный идентификатор из Yandex
            ],
            [
                'user_id'       => $user->id,
                'access_token'  => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? null,
                'expires_at'    => $expiresAt,
                'token_type'    => $data['token_type'] ?? null,
                'scope'         => $data['scope'] ?? null,
                'raw_response'  => collect($data)->except(['access_token', 'refresh_token', 'id_token'])->toArray(),
            ]
        );

        return response()->json(['status' => 'ok']);
    }
}
