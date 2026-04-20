<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'is_admin' => 'boolean',
        ]);

        $data['is_admin'] = $request->boolean('is_admin');
        User::query()->create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'is_admin' => 'nullable', // 👈 важно
        ]);

        // корректная обработка checkbox
        $data['is_admin'] = $request->boolean('is_admin');

        // защита: нельзя снять админку у самого себя
        if ($user->id === auth()->id()) {
            unset($data['is_admin']);
        }

        // пароль обновляем только если он передан
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('You cannot delete yourself');
        }
        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted');
    }
}
