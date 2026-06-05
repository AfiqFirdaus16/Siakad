<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputDataController extends Controller
{
    // Fungsi untuk membuat NISN acak (karena user_id sudah Auto Increment)
    private function generateNisn()
    {
        do {
            $nisn = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Student::where('NISN', $nisn)->exists()); // Huruf besar sesuai database

        return $nisn;
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'name' => 'required',
            'exam_score' => 'required|numeric',
            'attendance' => 'required|numeric',
            'previous_scores' => 'required|numeric',
            'hours_studied' => 'required|numeric',
            'tutoring_sessions' => 'required|numeric',
            'physical_activity' => 'required|numeric',
            'sleep_hours' => 'required|numeric',
            'access_to_resources' => 'required'
        ]);

        try {
            // 2. Simpan langsung ke satu tabel 'students'
            $student = Student::create([
                // user_id tidak perlu ditulis karena otomatis terisi oleh database
                'NISN' => $this->generateNisn(),
                'name' => $request->name,

                // Pemetaan ke kolom database yang hurufnya besar/kecil
                'Exam_Score' => $request->exam_score,
                'Attendance' => $request->attendance,
                'Previous_Scores' => $request->previous_scores,
                'Hours_Studied' => $request->hours_studied,
                'Tutoring_Sessions' => $request->tutoring_sessions,
                'Physical_Activity' => $request->physical_activity,
                'Sleep_Hours' => $request->sleep_hours,
                'Access_to_Resources' => $request->access_to_resources,
            ]);

            return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan secara manual! NISN: ' . $student->NISN);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // Fitur Import CSV yang sudah diaktifkan
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $fileData = fopen($file->getPathname(), 'r');

            fgetcsv($fileData); // Lewati baris pertama (Header CSV)

            $berhasil = 0;

            DB::beginTransaction();
            while (($row = fgetcsv($fileData)) !== false) {
                // Asumsi urutan kolom CSV dari downloadTemplate()
                Student::create([
                    'NISN' => $this->generateNisn(),
                    'name' => $row[0],
                    'Exam_Score' => $row[1],
                    'Attendance' => $row[2],
                    'Previous_Scores' => $row[3],
                    'Hours_Studied' => $row[4],
                    'Tutoring_Sessions' => $row[5],
                    'Physical_Activity' => $row[6],
                    'Sleep_Hours' => $row[7],
                    'Access_to_Resources' => $row[8],
                ]);
                $berhasil++;
            }
            DB::commit();
            fclose($fileData);

            return redirect()->back()->with('success', $berhasil . ' data siswa berhasil diimpor dari CSV!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal import CSV. Pastikan format sesuai template. Error: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $filename = 'template_siswa.csv';

        $callback = function () {
            $file = fopen('php://output', 'w');
            // Header CSV disesuaikan
            fputcsv($file, [
                'name',
                'exam_score',
                'attendance',
                'previous_scores',
                'hours_studied',
                'tutoring_sessions',
                'physical_activity',
                'sleep_hours',
                'access_to_resources'
            ]);

            // Contoh data agar user tidak bingung
            fputcsv($file, [
                'Budi Santoso',
                '85',
                '90',
                '80',
                '15',
                '2',
                '3',
                '7',
                'High'
            ]);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
