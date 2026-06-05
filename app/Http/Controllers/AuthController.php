<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Bebas dari masalah input form, tangkap 'email' atau 'username'
        $inputUser = $request->input('email') ?? $request->input('username');

        // 2. Terobos pintu utama Auth Laravel
        if (Auth::attempt(['email' => $inputUser, 'password' => $request->input('password')])) {

            // 3. HACK: Kita buat session manual ala cara lama Anda.
            // Ini berfungsi agar middleware('admin') tidak menendang Anda keluar lagi!
            session([
                'admin_id' => Auth::user()->id,
                'username' => Auth::user()->email
            ]);

            // 4. ARAHKAN LANGSUNG KE URL-NYA (Bukan pakai nama rute)
            return redirect('/dashboard');
        }

        return back()->with('error', 'Gagal masuk. Cek email dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan semua session saat logout
        session()->flush();

        return redirect('/');
    }
}
