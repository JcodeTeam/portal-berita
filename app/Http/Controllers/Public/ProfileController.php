<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'))->with('editMode', true);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        if ($user->role_id === 1) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;
        }

        if ($user->role_id === 2) {
            $rules['username'] = 'required|string|max:255';
            $rules['bio'] = 'nullable|string|max:1000';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/profiles/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('public/profiles');
            $validated['avatar'] = basename($avatarPath);
        }

        $user->name = $validated['name'];
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['avatar'])) {
            $user->avatar = $validated['avatar'];
        }
        $user->save();

        if ($user->role_id === 2 && $user->author) {
            $user->author->username = $validated['username'];
            $user->author->bio = $validated['bio'] ?? null;
            $user->author->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

}
