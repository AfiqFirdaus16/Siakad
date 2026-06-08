<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

Route::post('/verify-nisn', function (Request $request) {
    // 1. Cari siswa murni dari tabel students saja (tidak perlu bawa-bawa tabel user)
    $student = Student::where('NISN', $request->nisn)->first();

    // 2. Cek apakah NISN terdaftar di tabel students, 
    // DAN password yang diketik di form login EduTrace sama dengan NISN-nya
    if ($student && $request->password === $student->NISN) {

        // 3. Jika cocok, kembalikan data dasarnya saja ke EduTrace (tanpa email)
        return response()->json([
            'status' => 'success',
            'data' => [
                'nisn' => $student->NISN,
                'name' => $student->name,
                // Tambahkan data akademik lain di sini jika dibutuhkan nanti
            ]
        ]);
    }

    // Jika NISN tidak ada atau password tidak sama dengan NISN
    return response()->json(['status' => 'error', 'message' => 'NISN tidak terdaftar atau Password salah'], 401);
});
