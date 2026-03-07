<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_professors' => Professor::count(),
            'total_courses' => Course::count(),
            'total_faculties' => Faculty::count(),
            'total_departments' => Department::count(),
            'active_students' => Student::where('status', 'active')->count(),
            'new_students' => Student::where('status', 'new')->count(),
            'graduated_students' => Student::where('status', 'graduated')->count(),
        ];

        $recentStudents = Student::latest()->take(5)->get();
        $recentPayments = Payment::with('student')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentStudents', 'recentPayments'));
    }
}
