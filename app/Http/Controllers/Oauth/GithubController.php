<?php

namespace App\Http\Controllers\Oauth;

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
     * url: http://localhost:8080/github/verification-code
     */
    public function verificationCode(VerificationCodeRequest $request): Redirector|RedirectResponse {
        $this->authService->authenticate($request->getCode());

        return redirect('/')
            ->with('success', 'Вы успешно зарегистрировались и вошли в систему');
    }

    /** ToDo для студентов
     * url: http://localhost:8080/github/verification-code
     * url: http://localhost:8080/github/verification-code?code=4a2c3e8c53ea48927172
     */
    public function verificationCode2(Request $request)
    {
        // Получаем код из адресной строки
        $code = $request->get('code');
        if (!$code) {
            abort(400, 'Code обязательный параметр');
        }

        try {
            // Отправляем код и данные приложения в github для получения токенов
            $response = Http::asForm()
                ->withHeaders(['Accept' => 'application/json'])
                ->timeout(30)
                ->retry(3, 1000)
                ->post('https://github.com/login/oauth/access_token', [
                    'code'          => $code,
                    'redirect_uri'  => config('services.github.redirect_uri'),
                    'client_id'     => config('services.github.client_id'),
                    'client_secret' => config('services.github.client_secret'),
                ]);

            if ($response->failed()) {
                logger()->error('Github OAuth ошибка сервиса', $response->json());
                abort(500, 'Github OAuth ошибка сервиса');
            }
        } catch (ConnectionException $e) {
            logger()->error('Github OAuth ошибка подключения', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            abort(503, 'Временно невозможно подключиться к сервису авторизации. Пожалуйста, попробуйте позже.');
        } catch (Exception $e) {
            logger()->error('Github OAuth неожиданная ошибка', [
                'message' => $e->getMessage(),
                'class' => get_class($e),
            ]);
            abort(500, 'Произошла ошибка при авторизации');
        }


        $data = $response->json();
        $token = $data['access_token'];

        // Отправляем access_token в github, что бы получить email поль-ля.
        $response = Http::withToken($token)
            ->withHeaders([
                'Accept'     => 'application/vnd.github+json',
                'User-Agent' => 'Laravel-App',
            ])
            ->get('https://api.github.com/user/emails');

        if ($response->failed()) {
            logger()->error('Github OAuth не смог вернуть email пользователя', $response->json());
            abort(500, 'Github OAuth не смог вернуть email пользователя');
        }
        $emails = $response->json();
        $email = collect($emails)->firstWhere('primary', true)['email'] ?? null;
        if (!$email) {
            logger()->error('Не смогли получить email пользователя', $response->json());
            abort(500, 'Не смогли получить email пользователя');
        }


        // Запрашиваем остальные данные о пользователе
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.github.com/user');

        if ($userResponse->failed()) {
            logger()->error('Github Oauth не получилось получить данные о пол-ле', $userResponse->json());
            abort(500, 'Github Oauth не получилось получить данные о пол-ле');
        }
        $githubUser = $userResponse->json();

        // Сохраняем пол-ля в тбл users и данные в oauth_accounts
        $user = User::query()->firstOrCreate(
            ['email' => $email],
            [
                'name'     => $githubUser['name'] ?? $githubUser['login'],
                'password' => Hash::make(Str::random(10)),
            ]
        );

        // Логиним его сразу
        Auth::login($user);
        $request->session()->regenerate();

        $user = Auth::user(); // текущий авторизованный пользователь
        if (!$user) {
            abort(401, 'Текущий пользователь не найден');
        }

        // Сохраняем или обновляем запись
        OauthAccount::query()->updateOrCreate(
            [
                'provider'          => OauthAccount::GITHUB,
                'provider_user_id'  => $githubUser['id'],
            ],
            [
                'user_id'       => $user->id,
                'access_token'  => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? null,
                'expires_at'    => $data['expires_in'] ? Carbon::now()->addSeconds($data['expires_in']) : null,
                'refresh_token_expires_at' => $data['refresh_token_expires_in'] ? Carbon::now()->addSeconds($data['refresh_token_expires_in']) : null,
                'token_type'    => $data['token_type'] ?? null,
                'scope'         => $data['scope'] ?? null,
                'raw_response'  => collect($data)->toArray()//->except(['access_token', 'refresh_token']),
            ]
        );

        return redirect('/');
    }
}
