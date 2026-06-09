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
        $avgSleep = Student::avg('Sleep_Hours');
        $avgStudy = Student::avg('Hours_Studied');
        $avgTutor = Student::avg('Tutoring_Sessions');
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

        // Distribusi Sleep Hours
        $sleepDistribution = [
            Student::whereBetween('Sleep_Hours', [0, 4])->count(),
            Student::whereBetween('Sleep_Hours', [5, 6])->count(),
            Student::whereBetween('Sleep_Hours', [7, 8])->count(),
            Student::whereBetween('Sleep_Hours', [9, 10])->count(),
            Student::where('Sleep_Hours', '>', 10)->count(),
        ];

        // Distribusi Access to Resources
        $resourceDistribution = [
            Student::where('Access_to_Resources', 'Low')->count(),
            Student::where('Access_to_Resources', 'Medium')->count(),
            Student::where('Access_to_Resources', 'High')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalSiswa',

            'avgAttendance',
            'avgSleep',
            'avgStudy',
            'avgTutor',
            'avgPreviousScore',

            'attendanceDistribution',
            'scoreDistribution',
            'studyDistribution',
            'sleepDistribution',

            'resourceDistribution',
        ));
    }
}