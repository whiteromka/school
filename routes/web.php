<?php

use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\GoogleController;
use App\Http\Controllers\Oauth\YandexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Illuminate\Http\Request $request) {
    return view('welcome', [
        'yandexClientId' => config('services.yandex.client_id'),
        'githubClientId' => config('services.github.client_id'),
        'clientIp' => $request->ip(),
    ]);
});

Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/test', [UserController::class, 'test'])->name('user.test');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// OAuth Login services
Route::get('/yandex/verification-code',  [YandexController::class, 'verificationCode'])->name('yandex.verificationCode');
Route::get('/github/verification-code',  [GithubController::class, 'verificationCode'])->name('github.verificationCode');

Route::get('/google/login', [GoogleController::class, 'login'])->name('google.login');
Route::get('/google/verification-code', [GoogleController::class, 'verificationCode']);

Route::get('/test/test',  [TestController::class, 'test'])->name('test.test');
Route::get('/test/test2',  [TestController::class, 'test2'])->name('test.test2');
