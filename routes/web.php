<?php

use App\Http\Controllers\LkController;
use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\GoogleController;
use App\Http\Controllers\Oauth\YandexController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TelegramAuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TgbotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/site/front', [SiteController::class, 'front'])->name('site.front');
Route::get('/site/back', [SiteController::class, 'back'])->name('site.back');
Route::get('/site/gamedev', [SiteController::class, 'gamedev'])->name('site.gamedev');
Route::get('/site/english', [SiteController::class, 'english'])->name('site.english');

Route::get('/site/account', [SiteController::class, 'account'])->name('account');

Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/test', [UserController::class, 'test'])->name('user.test');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

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

// Tg
Route::get('/test/tg', [TestController::class, 'tg'])->name('test.tg');
Route::post('/tgbot/events', [TgbotController::class, 'events']);

Route::get('/telegram-auth/auth', [TelegramAuthController::class, 'auth'])
    ->name('telegram-auth.auth');

// LK
Route::get('/user/lk', [UserController::class, 'lk'])
    ->name('user.lk');
// ===============================================================

Route::resource('users', UsersController::class);
Route::get('/users/show/{user}', [UsersController::class, 'show'])->name('users.show');
//Route::get('/users/show/{id}', [UsersController::class, 'show'])->name('users.show');
//Route::get('/users/show/{id}', [UsersController::class, 'show'])
//    ->where('id', '[0-9]+')
//    ->name('users.show');
//
//Route::get('/users/show/{id}', [UsersController::class, 'show'])
//    ->whereNumber('id')
//    ->name('users.show');

// Вакансии
Route::get('/vacancy/check', [VacancyController::class, 'check'])->name('vacancy.check');
Route::get('/vacancy/load-more', [VacancyController::class, 'loadMore'])->name('vacancy.loadMore');
