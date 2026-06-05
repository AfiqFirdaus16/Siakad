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

        $avgExam = Student::avg('exam_score');

        $avgAttendance = Student::avg('attendance');

        $avgStudy = Student::avg('hours_studied');

        $avgSleep = Student::avg('sleep_hours');

        $examDistribution = [
            Student::whereBetween('exam_score', [0, 20])->count(),
            Student::whereBetween('exam_score', [21, 40])->count(),
            Student::whereBetween('exam_score', [41, 60])->count(),
            Student::whereBetween('exam_score', [61, 80])->count(),
            Student::whereBetween('exam_score', [81, 100])->count(),
        ];

        $attendanceDistribution = [
            Student::whereBetween('attendance', [0, 20])->count(),
            Student::whereBetween('attendance', [21, 40])->count(),
            Student::whereBetween('attendance', [41, 60])->count(),
            Student::whereBetween('attendance', [61, 80])->count(),
            Student::whereBetween('attendance', [81, 100])->count(),
        ];

        $studyDistribution = [
            Student::whereBetween('hours_studied', [0, 5])->count(),
            Student::whereBetween('hours_studied', [6, 10])->count(),
            Student::whereBetween('hours_studied', [11, 15])->count(),
            Student::whereBetween('hours_studied', [16, 20])->count(),
            Student::where('hours_studied', '>', 20)->count(),
        ];

        $sleepDistribution = [
            Student::whereBetween('sleep_hours', [0, 2])->count(),
            Student::whereBetween('sleep_hours', [3, 4])->count(),
            Student::whereBetween('sleep_hours', [5, 6])->count(),
            Student::whereBetween('sleep_hours', [7, 8])->count(),
            Student::where('sleep_hours', '>', 8)->count(),
        ];

        return view('admin.dashboard', compact(
            'totalSiswa',
            'avgExam',
            'avgAttendance',
            'avgStudy',
            'avgSleep',
            'examDistribution',
            'attendanceDistribution',
            'studyDistribution',
            'sleepDistribution'
        ));
    }
}
