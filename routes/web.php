<?php

use App\Http\Controllers\Oauth\GithubController;
use App\Http\Controllers\Oauth\YandexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'yandexClientId' => config('services.yandex.client_id'),
        'githubClientId' => config('services.github.client_id'),
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

Route::get('/test/test',  [TestController::class, 'test'])->name('test.test');
Route::get('/test/test2',  [TestController::class, 'test2'])->name('test.test2');
Route::get('/test/rpg-game',  [TestController::class, 'rpgGame'])->name('test.rpgGame');
Route::get('/test/business',  [TestController::class, 'business'])->name('test.business');
Route::get('/test/notification',  [TestController::class, 'testNotification'])->name('test.testNotification');

Route::get('/users/index', [UsersControllers::class, 'index'])->name('users.index');
Route::get('/users/first-user', [UsersControllers::class, 'firstUser'])->name('users.firstUser');
Route::get('/users/user-by-id/{id}', [UsersControllers::class, 'userById'])->name('users.userById');
Route::get('/users/users-emails/{usersEmails}', [UsersControllers::class, 'usersEmails'])->name('users.usersEmails');
Route::get('/users/delete-user/{id}', [UsersControllers::class, 'deleteUser'])->name('users.deleteUser');
Route::get('/users/create-users/{numberOfUsers}', [UsersControllers::class, 'createUsers'])->name('users.createUsers');
Route::get('/users/update-user/{id}', [UsersControllers::class, 'updateUser'])->name('users.updateUser');
Route::get('/users/create', [UsersControllers::class, 'create'])->name('users.create');
Route::post('/users', [UsersControllers::class, 'store'])->name('users.store');
Route::post('/users/update', [UsersControllers::class, 'update'])->name('users.update');
//Route::get('/users/show-update-form/{id}', [UsersControllers::class, 'showUpdateForm'])->name('users.showUpdateForm');
Route::get('/users/show-update-form/{user}', [UsersControllers::class, 'showUpdateForm'])->name('users.showUpdateForm');
