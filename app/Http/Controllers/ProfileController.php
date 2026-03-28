<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdatePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService
    )
    {}

    // GET /profile
    public function index(): Factory|View
    {
        /** @var User $user */
        $user = auth()->user();
        $this->profileService->checkOrCreateProfile(['user_id' => $user->id]);
        $user->load(['profile', 'activeModules.module']);
        $name = mb_str_split(str_replace(' ', '_', $user->getFullNameOrEmail()));

        return view('profile.index', [
            'user' => $user,
            'name' => $name,
        ]);
    }

    // POST /profile
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $userData = $request->userData();
        $telegramChanged = isset($userData['telegram']) && $userData['telegram'] !== $user->telegram;

        if (!empty($userData)) {
            $user->update($userData);
        }

        $profile = $user->profile;
        if ($profile) {
            $profile->update($request->profileData());
        }

        $message = 'Профиль успешно обновлён';
        if ($telegramChanged && !empty($userData['telegram'])) {
            $message .= '. Пожалуйста, напишите нашему боту в Telegram <b>@school_test_123_bot</b> "привет", это позволит нам уведомить вас о начале занятий и возможности оплатить курс!';
        }

        return redirect()->route('profile.index')->with('success', $message);
    }

    // GET /profile/update-password
    public function updatePasswordView(): Factory|View
    {
        /** @var User $user */
        $user = auth()->user();
        return view('profile.updatePasswordView', ['user' => $user]);
    }

    // POST /profile/update-password
    public function updatePassword(ProfileUpdatePasswordRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->update([
            'password' => $request->input('password'),
            'password_verified' => 1,
        ]);

        return redirect()->route('profile.index')->with('success', 'Пароль успешно обновлён');
    }
}
