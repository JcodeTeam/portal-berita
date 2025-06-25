<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('google.redirect')->with('error', 'Email tidak ditemukan, silakan login dengan Google.');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role_id === 2 && !$user->author) {
                Author::create([
                    'user_id' => $user->id,
                    'username' => Str::slug($user->name) . '-' . uniqid(),
                    'employee_code' => 'CNEWS-' . strtoupper(Str::random(4)),
                    'bio' => null,
                ]);
            }

            switch ($user->role_id) {
                case 1: // Admin
                    return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
                case 2: // Redaksi
                    return redirect()->route('redaksi.index')->with('success', 'Login berhasil!');
                default:
                    return redirect()->intended('/')->with('success', 'Login berhasil!');
            }
        }


        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
