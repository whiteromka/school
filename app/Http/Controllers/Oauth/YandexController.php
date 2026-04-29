<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Services\OAuth\OAuthServiceInterface;
use App\Services\SlackLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class YandexController extends Controller
{
    public function __construct(
        private readonly OAuthServiceInterface $authService
    ) {}

    /**
     * Страница на которую редиректит яндекс с кодом в url
     * url: http://localhost:8080/yandex/verification-code
     */
    public function verificationCode(Request $request): Redirector|RedirectResponse
    {
        try {
            $code = $request->string('code')->toString();
            if (!$code) {
                abort(400, 'Code не найден');
            }
            $this->authService->authenticate($code);

            return redirect('/profile')->with('success', 'Вы успешно авторизовались через ' . SlackLog::OAUTH_YANDEX);
        } catch (Throwable $e) {
            SlackLog::log($e, SlackLog::OAUTH_YANDEX);
            return redirect('/login')->with('error', 'Ошибка авторизации через ' . SlackLog::OAUTH_YANDEX);
        }
    }
}
