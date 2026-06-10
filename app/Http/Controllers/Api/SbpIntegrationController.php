<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class SbpIntegrationController extends Controller
{
    public function getStudentData($nisn): JsonResponse
    {
        // 1. Cari siswa berdasarkan NISN (Tanpa relasi karena data sudah jadi 1 tabel)
        // Pastikan 'NISN' sesuai dengan huruf kapital di database
        $siswa = Student::where('NISN', $nisn)->first();

        // 2. Jika NISN tidak ditemukan di SIAKAD
        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa dengan NISN ' . $nisn . ' tidak ditemukan'
            ], 404);
        }

        // 3. Jika ditemukan, format datanya untuk dikirim ke web SBP
        return response()->json([
            'status' => 'success',
            'data' => [
                // Identitas
                'nisn' => $siswa->NISN,
                'nama' => $siswa->name ?? '-',

                // Variabel dari data akademik (SIAKAD / Guru)
                'attendance'        => $siswa->Attendance ?? 0,
                'previous_scores'   => $siswa->Previous_Scores ?? 0,
                'hours_studied'     => $siswa->Hours_Studied ?? 0,
            ]
        ], 200);
    }
}
