<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah pengguna sudah ada di database
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Jika pengguna ada, coba login
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                // Jika password salah
                return back()->withErrors([
                    'password' => 'Password salah.',
                ]);
            }
        } else {
            // Ambil bagian sebelum '@' sebagai name
            $username = explode('@', $credentials['email'])[0];

            // Jika pengguna tidak ada, buat akun baru
            $newUser = User::create([
                'name' => $username, // Gunakan bagian sebelum '@' dari email
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']), // Hash password
                'level' => $request->input('level', 'kesiswaan'), // Default level
            ]);

            // Login pengguna baru
            Auth::login($newUser);
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}