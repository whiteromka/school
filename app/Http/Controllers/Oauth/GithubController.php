<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Http\Requests\OAuth\VerificationCodeRequest;
use App\Services\OAuth\OAuthServiceInterface;
use App\Services\SlackLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Throwable;

class GithubController extends Controller
{
    public function __construct(
        private readonly OAuthServiceInterface $authService
    ) {}

    /**
     * Страница на которую редиректит github с кодом в url
     * url: http://localhost:8080/github/verification-code
     */
    public function verificationCode(VerificationCodeRequest $request): Redirector|RedirectResponse
    {
        try {
            $this->authService->authenticate($request->getCode());

            return redirect('/profile')->with('success', 'Вы успешно авторизовались через Github');
        } catch (Throwable $e) {
            SlackLog::log($e, SlackLog::OAUTH_GITHUB);
            return redirect('/login')->with('error', 'Ошибка авторизации через ' . SlackLog::OAUTH_GITHUB);
        }
    }
}
