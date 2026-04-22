<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
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

// site
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

// Вакансии
Route::get('/vacancy/check', [VacancyController::class, 'check'])->name('vacancy.check');
Route::get('/vacancy/load-more', [VacancyController::class, 'loadMore'])->name('vacancy.loadMore');

// Business request
Route::get('/business-request/create', [BusinessRequestController::class, 'create'])->name('businessRequest.create');
Route::post('/business-request/store', [BusinessRequestController::class, 'store'])->name('businessRequest.store');

// Reviews
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/review/user-modules', [ReviewController::class, 'userModules'])->name('review.userModules');

// Тех Стек
Route::get('/tech-stack/info/{id}', [TechStackController::class, 'info'])->name('techStack.info');
Route::get('/review/list', [ReviewController::class, 'index'])->name('review.list')->middleware('auth');
Route::post('/review/delete-review/{id}', [ReviewController::class, 'deleteReview'])->name('review.deleteReview')->middleware('auth');
Route::get('/review/get-by-id/{id}', [ReviewController::class, 'getById'])->name('review.getById')->middleware('auth');
Route::post('/review/update', [ReviewController::class, 'update'])->name('review.update')->middleware('auth');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/update-password-view', [ProfileController::class, 'updatePasswordView'])->name('profile.update-password-view')->middleware('auth');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');

// Admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::resource('users', UserController::class);
        Route::resource('settings', SettingController::class);
    });

// Tests
Route::get('/test/test1', [TestController::class, 'test1'])->name('test.test1');
Route::get('/test/hh', [TestController::class, 'hh'])->name('test.hh');
Route::get('/test/hh-simple', [TestController::class, 'hhSimple'])->name('test.hhSimple');
