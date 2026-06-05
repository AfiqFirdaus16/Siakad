<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DataAkademikController extends Controller
{
    public function index(Request $request)
    {
        // 1. Langsung panggil tabel utamanya (HAPUS fungsi ->with jika ada)
        $query = Student::query();

        // 2. Fitur Pencarian
        if ($request->filled('nisn')) {
            $query->where(
                'NISN',
                'like',
                '%' . $request->nisn . '%'
            );
        }

        // 3. Urutkan berdasarkan user_id dan atur paginasi
        $students = $query
            ->orderBy('user_id')
            ->paginate(25);

        return view(
            'admin.data-akademik',
            compact('students')
        );
    }
}
