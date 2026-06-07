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
        if ($request->filled('search')) {

            // 2. Kita bungkus kuerinya agar mencari di kolom NISN "ATAU" name
            $query->where(function ($q) use ($request) {
                $q->where('NISN', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $students = $query
            ->orderBy('user_id', 'asc')
            ->paginate(25);

        return view('admin.data-akademik', compact('students'));
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
