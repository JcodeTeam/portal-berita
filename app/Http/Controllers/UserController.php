<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    //
    public function index(): View
    {
        $users = User::with('role')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }


    public function create(): View
    {
        // Ambil daftar role untuk dropdown
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role_id'                  => 'required|exists:roles,id',
            'name'                     => 'required|string|max:255',
            'email'                    => 'required|email|unique:users,email',
            'password'                 => 'required|string|min:8|confirmed',
            'avatar'                   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/profiles');
            $validated['avatar'] = basename($path);
        }

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User baru berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role_id'                  => 'required|exists:roles,id',
            'name'                     => 'required|string|max:255',
            'email'                    => 'required|email|unique:users,email,' . $user->id,
            'password'                 => 'nullable|string|min:8|confirmed',
            'avatar'                   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/profiles');
            $validated['avatar'] = basename($path);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }
}
