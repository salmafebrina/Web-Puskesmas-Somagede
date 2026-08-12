<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect('/admin');
            }

            if ($user->role == 'pendaftaran') {
                return redirect('/pendaftaran');
            }

            if ($user->role == 'pemeriksaan') {
                return redirect('/pemeriksaan');
            }

            if ($user->role == 'pembayaran') {
                return redirect('/pembayaran');
            }

            if ($user->role == 'farmasi') {
                return redirect('/farmasi');
            }

            Auth::logout();

            return back()->with('error', 'Role pengguna tidak dikenali.');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}