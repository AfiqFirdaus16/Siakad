<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputDataController extends Controller
{
    // Fungsi untuk membuat NISN acak 8 digit otomatis
    private function generateNisn()
    {
        do {
            $nisn = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Student::where('NISN', $nisn)->exists()); // Pastikan tidak ada yang kembar

        return $nisn;
    }

    // ==========================================
    // 1. FITUR INPUT MANUAL
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required',
            'exam_score'          => 'required|numeric',
            'attendance'          => 'required|numeric',
            'previous_scores'     => 'required|numeric',
            'hours_studied'       => 'required|numeric',
            'tutoring_sessions'   => 'required|numeric',
            'physical_activity'   => 'required|numeric',
            'sleep_hours'         => 'required|numeric',
            'access_to_resources' => 'required'
        ]);

        try {
            // Perhatikan: user_id tidak kita tulis di sini karena Database otomatis membuatkannya.
            $student = Student::create([
                'NISN'                => $this->generateNisn(), // Generate otomatis
                'name'                => $request->name,

                'Exam_Score'          => $request->exam_score,
                'Attendance'          => $request->attendance,
                'Previous_Scores'     => $request->previous_scores,
                'Hours_Studied'       => $request->hours_studied,
                'Tutoring_Sessions'   => $request->tutoring_sessions,
                'Physical_Activity'   => $request->physical_activity,
                'Sleep_Hours'         => $request->sleep_hours,
                'Access_to_Resources' => $request->access_to_resources,
            ]);

            return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan secara manual! NISN: ' . $student->NISN);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // ==========================================
    // 2. FITUR IMPORT CSV
    // ==========================================
    public function import(Request $request)
    {
        // 1. MODIFIKASI VALIDASI: Melonggarkan ukuran hingga 10MB (10240 KB)
        // dan menambahkan pesan error berbahasa Indonesia agar mudah dipahami.
        $request->validate([
            'file' => 'required|file|max:10240',
        ], [
            'file.required' => 'Anda belum memilih file CSV untuk diunggah.',
            'file.file'     => 'Format yang Anda unggah tidak valid.',
            'file.max'      => 'Ukuran file terlalu besar! Maksimal 10MB.'
        ]);

        try {
            $file = $request->file('file');
            $fileData = fopen($file->getPathname(), 'r');

            fgetcsv($fileData); // Lewati baris pertama (Header CSV)

            $berhasil = 0;

            DB::beginTransaction();
            while (($row = fgetcsv($fileData, 1000, ",")) !== false) {

                // Pastikan baris tidak kosong
                if (isset($row[0])) {
                    Student::create([
                        // user_id -> Otomatis dibuatkan oleh database

                        // NISN -> Kita generate otomatis (mengabaikan NISN bawaan CSV)
                        'NISN'                => $this->generateNisn(),

                        // Name -> Kosongkan karena di CSV asli Anda tidak ada kolom nama siswa
                        'name'                => null,

                        // Membaca urutan index array berdasarkan kolom CSV ASLI Anda
                        'Exam_Score'          => $row[1] ?? 0,
                        'Attendance'          => $row[2] ?? 0,
                        'Hours_Studied'       => $row[3] ?? 0,
                        'Previous_Scores'     => $row[4] ?? 0,
                        'Tutoring_Sessions'   => $row[5] ?? 0,
                        'Physical_Activity'   => $row[6] ?? 0,
                        'Sleep_Hours'         => $row[7] ?? 0,
                        'Access_to_Resources' => $row[8] ?? 'Medium',
                    ]);
                    $berhasil++;
                }
            }
            DB::commit();
            fclose($fileData);

            return redirect()->back()->with('success', $berhasil . ' data siswa berhasil diimpor otomatis dari CSV!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal import CSV. Error: ' . $e->getMessage());
        }
    }

    // ==========================================
    // 3. DOWNLOAD TEMPLATE
    // ==========================================
    public function downloadTemplate()
    {
        $filename = 'template_siswa.csv';

        $callback = function () {
            $file = fopen('php://output', 'w');

            // Header CSV disesuaikan dengan urutan kolom Import CSV di atas
            fputcsv($file, [
                'NISN',
                'Exam_Score',
                'Attendance',
                'Hours_Studied',
                'Previous_Scores',
                'Tutoring_Sessions',
                'Physical_Activity',
                'Sleep_Hours',
                'Access_to_Resources'
            ]);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
