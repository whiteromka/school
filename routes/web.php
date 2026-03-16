<?php

use App\Http\Controllers\BusinessRequestController;
use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\GoogleController;
use App\Http\Controllers\Oauth\YandexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TechStackController;
use App\Http\Controllers\TelegramAuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TgbotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/site/front', [SiteController::class, 'front'])->name('site.front');
Route::get('/site/back', [SiteController::class, 'back'])->name('site.back');
Route::get('/site/gamedev', [SiteController::class, 'gamedev'])->name('site.gamedev');
Route::get('/site/english', [SiteController::class, 'english'])->name('site.english');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

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

// ===============================================================

Route::resource('users', UsersController::class);
Route::get('/users/show/{user}', [UsersController::class, 'show'])->name('users.show');

// Вакансии
Route::get('/vacancy/check', [VacancyController::class, 'check'])->name('vacancy.check');
Route::get('/vacancy/load-more', [VacancyController::class, 'loadMore'])->name('vacancy.loadMore');

// Business request
Route::get('/business-request/create', [BusinessRequestController::class, 'create'])->name('businessRequest.create');
Route::post('/business-request/store', [BusinessRequestController::class, 'store'])->name('businessRequest.store');

// Reviews
Route::get('/review/form', [ReviewController::class, 'form'])->name('review.form');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/review/refresh-captcha', [ReviewController::class, 'refreshCaptcha'])->name('review.refresh-captcha');

Route::get('/tech-stack/info/{id}', [TechStackController::class, 'info'])->name('techStack.info');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/update-password-view', [ProfileController::class, 'updatePasswordView'])->name('profile.update-password-view')->middleware('auth');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');
