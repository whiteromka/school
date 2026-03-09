<?php

namespace App\Http\Controllers\Oauth;

use App\Enums\OAuthProvider;
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

        return redirect('/profile')->with('success', 'Вы успешно авторизовались через Yandex');
    }
}
