<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService
    )
    {}

    // GET /profile
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $this->profileService->checkOrCreateProfile(['user_id' => $user->id]);
        $user->load('profile');
        $name = mb_str_split(str_replace(' ', '_', $user->getFullNameOrEmail()));

        return view('profile.index', [
            'user' => $user,
            'name' => $name,
        ]);
    }

    // POST /profile
    public function update(ProfileUpdateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $userData = $request->userData();
        if (!empty($userData)) {
            $user->update($userData);
        }

        $profile = $user->profile;
        if ($profile) {
            $profile->update($request->profileData());
        }

        return redirect()->route('profile.index')->with('success', 'Профиль успешно обновлён');
    }
}
