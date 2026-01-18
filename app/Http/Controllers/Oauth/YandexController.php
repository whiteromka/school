<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Models\OauthAccount;
use App\Models\User;
use App\Services\OAuth\OAuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class YandexController extends Controller
{
    public function __construct(
        private readonly OAuthServiceInterface $authService
    ) {}

    /**
     * url: http://localhost:8080/yandex/verification-code
     */
    public function verificationCode(Request $request): Redirector|RedirectResponse
    {
        $code = $request->string('code')->toString();
        if (!$code) {
            abort(400, 'Code не найден');
        }
        $this->authService->authenticate($code);

        return redirect('/')->with('success', 'Ура! Вы успешно зарегистрировались и вошли в систему');
    }

    /**
     * Показать студентам как накидывал код, и потом оптимизировал
     */
    public function verificationCodeOld(Request $request)
    {
        // Получаем код из адресной строки
        $code = $request->get('code');
        if (!$code) {
            abort(400, 'Authorization code not found');
        }

        // Отправляем код и данные приложения в яндекс для получения токенов
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

        $data = $response->json(); // Array // Тут токены
// $data =
//         {
//             "access_token": "aaa",
//             "expires_in": 31536000, // $expiresAt = now()->addSeconds(31536000); // 1 год //
//             "refresh_token": "bbb",
//             "token_type": "bearer"
//         }

        $token = $data['access_token'];
        // Отправляем access_token в яндекс, что бы получить информацию о пользователе.
        $userResponse = Http::withHeaders([
            'Authorization' => 'OAuth ' . $token,
        ])->get('https://login.yandex.ru/info');

        if ($userResponse->failed()) {
            logger()->error('Yandex user info error', $userResponse->json());
            abort(500, 'Failed to fetch Yandex user info');
        }

        $yandexUser = $userResponse->json();

        // Сохраняем пол-ля в тбл users и данные в oauth_accounts
        $email = strtolower($yandexUser['default_email'] ?? $yandexUser['emails'][0]);
        if (!$email) {
            logger()->error('Yandex user email error', $userResponse->json());
            abort(500, 'Bad data user from Yandex');
        }
        $user = User::query()->firstOrCreate(
            ['email' => $email],
            [
                'name'     => $yandexUser['first_name'],
                'last_name'=> $yandexUser['last_name'] ?? null,
                'password' => Hash::make(Str::random(10)),
            ]
        );

        // Логиним его сразу
        Auth::login($user);
        $request->session()->regenerate();

        $user = Auth::user(); // текущий авторизованный пользователь
        if (!$user) {
            abort(401, 'User not authenticated');
        }

        // Сохраняем или обновляем запись
        OauthAccount::query()->updateOrCreate(
            [
                'provider'          => OauthAccount::YANDEX,
                'provider_user_id'  => $yandexUser['id'],
            ],
            [
                'user_id'       => $user->id,
                'access_token'  => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? null,
                'expires_at'    => $data['expires_in'] ? Carbon::now()->addSeconds($data['expires_in']) : null,
                'token_type'    => $data['token_type'] ?? null,
                'scope'         => $data['scope'] ?? null,
                'raw_response'  => collect($data)->toArray()//->except(['access_token', 'refresh_token']),
            ]
        );

        return redirect('/');
    }
}
