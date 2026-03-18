<?php

namespace App\Http\Controllers\Oauth;

use App\Enums\OAuthProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\OAuth\VerificationCodeRequest;
use App\Models\OauthAccount;
use App\Models\User;
use App\Services\OAuth\OAuthServiceInterface;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        $this->authService->authenticate($request->getCode());

        return redirect('/profile')->with('success', 'Вы успешно авторизовались через Github');
    }
}
