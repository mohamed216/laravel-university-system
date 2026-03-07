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
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Quick Stats Cards
        $stats = [
            'total_students' => Student::count(),
            'total_professors' => Professor::count(),
            'total_courses' => Course::count(),
            'total_faculties' => Faculty::count(),
            'total_departments' => Department::count(),
            'active_students' => Student::where('status', 'active')->count(),
            'new_students' => Student::where('status', 'new')->count(),
            'graduated_students' => Student::where('status', 'graduated')->count(),
            'pending_enrollments' => Enrollment::where('status', 'pending')->count(),
            'total_payments' => Payment::sum('amount'),
            'pending_payments' => 0,
        ];

        // Recent items
        $recentStudents = Student::latest()->take(5)->get();
        $recentPayments = Payment::with('student')->latest()->take(5)->get();
        
        // Student Enrollment Trends (Last 12 months)
        $enrollmentTrends = Student::select(
            DB::raw('strftime("%Y-%m", enrollment_date) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('enrollment_date', '>=', Carbon::now()->subMonths(12)->toDateString())
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        // Fee Collection Trends (Last 12 months)
        $feeTrends = Payment::select(
            DB::raw('strftime("%Y-%m", payment_date) as month'),
            DB::raw('SUM(amount) as total')
        )
        ->where('payment_date', '>=', Carbon::now()->subMonths(12)->toDateString())
        
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        // Department-wise student distribution
        $departmentDistribution = Department::withCount('students')
            ->get()
            ->pluck('students_count', 'name');
        
        // Recent activities
        $recentActivities = Activity::with('user')->latest()->take(10)->get();

        return view('dashboard', compact(
            'stats', 
            'recentStudents', 
            'recentPayments',
            'enrollmentTrends',
            'feeTrends',
            'departmentDistribution',
            'recentActivities'
        ));
    }
}
