<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display users list page
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Get data for DataTables (server-side processing)
     */
    public function data()
    {
        $users = User::query();

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '
                    <a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('admin.users.destroy', $user->id) . '" method="POST" class="d-inline"
                          onsubmit="return confirm(\'Are you sure?\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? $user->created_at->format('Y-m-d H:i') : '-';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'telegram' => $request->telegram,
            'password' => Hash::make($request->password),
            'additional_data' => json_encode([]),
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(UserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'telegram' => $request->telegram,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully!');
    }
}
