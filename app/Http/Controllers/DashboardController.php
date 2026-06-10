<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\LearningHabit;
use App\Models\Student;
use App\Models\StudentSelectedFeature;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Student::count();

        // Rata-rata numerik
        $avgAttendance = Student::avg('Attendance');
        $avgStudy = Student::avg('Hours_Studied');
        $avgPreviousScore = Student::avg('Previous_Scores');

        // Distribusi Attendance
        $attendanceDistribution = [
            Student::whereBetween('Attendance', [0, 20])->count(),
            Student::whereBetween('Attendance', [21, 40])->count(),
            Student::whereBetween('Attendance', [41, 60])->count(),
            Student::whereBetween('Attendance', [61, 80])->count(),
            Student::whereBetween('Attendance', [81, 100])->count(),
        ];

        // Distribusi Previous Score
        $scoreDistribution = [
            Student::whereBetween('Previous_Scores', [0, 20])->count(),
            Student::whereBetween('Previous_Scores', [21, 40])->count(),
            Student::whereBetween('Previous_Scores', [41, 60])->count(),
            Student::whereBetween('Previous_Scores', [61, 80])->count(),
            Student::whereBetween('Previous_Scores', [81, 100])->count(),
        ];

        // Distribusi Hours Studied
        $studyDistribution = [
            Student::whereBetween('Hours_Studied', [0, 5])->count(),
            Student::whereBetween('Hours_Studied', [6, 10])->count(),
            Student::whereBetween('Hours_Studied', [11, 15])->count(),
            Student::whereBetween('Hours_Studied', [16, 20])->count(),
            Student::where('Hours_Studied', '>', 20)->count(),
        ];

        return view('admin.dashboard', compact(
            'totalSiswa',

            'avgAttendance',
            'avgStudy',
            'avgPreviousScore',

            'attendanceDistribution',
            'scoreDistribution',
            'studyDistribution',
        ));
    }
}