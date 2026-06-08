<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

Route::post('/verify-nisn', function (Request $request) {
    // 1. Cari siswa berdasarkan NISN (beserta relasi user-nya)
    $student = Student::with('user')->where('NISN', $request->nisn)->first();

    if ($student && $student->user) {

        // 2. LOGIKA PINTAR: Cek apakah password yang diketik adalah NISN (Default)
        // ATAU password asli yang ada di tabel users SIAKAD
        $isPasswordNisn = ($request->password === $student->NISN);
        $isPasswordAsli = Hash::check($request->password, $student->user->password);

        if ($isPasswordNisn || $isPasswordAsli) {

            // 3. Jika salah satu cocok, kembalikan data ke EduTrace
            return response()->json([
                'status' => 'success',
                'data' => [
                    'nisn' => $student->NISN,
                    'name' => $student->name,
                    'email' => $student->user->email,
                ]
            ]);
        }
    }

    return response()->json(['status' => 'error', 'message' => 'NISN atau Password salah'], 401);
});
