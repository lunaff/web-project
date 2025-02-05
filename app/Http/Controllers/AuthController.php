<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kredensial login
        if (Auth::attempt($credentials, $request->remember)) {
            // Regenerasi session untuk menghindari session fixation
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Arahkan ke dashboard
        }

        // Jika login gagal, kembalikan error
        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        // Logout dan reset session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
