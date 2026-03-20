<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/review/refresh-captcha', [ReviewController::class, 'refreshCaptcha'])->name('review.refresh-captcha');

Route::get('/tech-stack/info/{id}', [TechStackController::class, 'info'])->name('techStack.info');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/update-password-view', [ProfileController::class, 'updatePasswordView'])->name('profile.update-password-view')->middleware('auth');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');

// ===============================================================
// Admin Panel Routes
// ===============================================================

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        // Users CRUD /admin/users
        Route::get('/users', [AdminUserController::class, 'index'])->name('users');
        Route::get('/users/data', [AdminUserController::class, 'data'])->name('users.data');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Modules CRUD /admin/modules
        Route::get('/modules', [AdminModuleController::class, 'index'])->name('modules');
        Route::get('/modules/data', [AdminModuleController::class, 'data'])->name('modules.data');
        Route::get('/modules/create', [AdminModuleController::class, 'create'])->name('modules.create');
        Route::post('/modules', [AdminModuleController::class, 'store'])->name('modules.store');
        Route::get('/modules/{module}/edit', [AdminModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [AdminModuleController::class, 'update'])->name('modules.update');
        Route::delete('/modules/{module}', [AdminModuleController::class, 'destroy'])->name('modules.destroy');
    });
});
