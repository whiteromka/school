<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(): Factory|View
    {
        return view('auth.login');
    }

    public function showRegister(): Factory|View
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->credentials())) {
            return back()->withErrors([
                'email' => 'Неверный email или пароль',
            ]);
        }
        $request->session()->regenerate();

        return redirect('/');
    }

    public function register(RegisterRequest $request): Redirector|RedirectResponse
    {
        $user = $this->userRepository->create($request->credentials());
        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request): Redirector|RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
