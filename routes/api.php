<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Controllers\Api\SbpIntegrationController;

// ================================================================
// RUTE 1: UNTUK KEBUTUHAN LOGIN EDUTRACE (POST)
// ================================================================
Route::post('/verify-nisn', function (Request $request) {
    // 1. Cari siswa murni dari tabel students
    $student = Student::where('NISN', $request->nisn)->first();

    // 2. Cek kecocokan NISN dan password
    if ($student && $request->password === $student->NISN) {
        // 3. Jika cocok, kembalikan data
        return response()->json([
            'status' => 'success',
            'data' => [
                'nisn' => $student->NISN,
                'name' => $student->name,
            ]
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'NISN tidak terdaftar atau Password salah'], 401);
});


// ================================================================
// RUTE 2: JALAN PINTAS NGETES LEWAT BROWSER (GET)
// ================================================================
Route::get('/cek-siswa/{nisn}', function ($nisn) {
    // Cari siswa berdasarkan NISN yang diketik di URL
    $student = \App\Models\Student::where('NISN', $nisn)->first();

    if ($student) {
        return response()->json([
            'status' => 'DATA DITEMUKAN BOS!',
            'nama' => $student->name,
            'nisn' => $student->NISN
        ]);
    }

    return response()->json([
        'status' => 'KOSONG',
        'pesan' => 'NISN tersebut TIDAK ADA di database SIAKAD Railway'
    ]);
});

// ================================================================
// RUTE 3: UNTUK KEBUTUHAN INTEGRASI WEB SBP
// ================================================================
Route::get('/student/{nisn}', [
    SbpIntegrationController::class,
    'getStudentData'
]);