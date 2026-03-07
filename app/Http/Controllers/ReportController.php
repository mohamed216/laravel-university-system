<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Department;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        
        return view('reports.index', compact('departments'));
    }

    public function students(Request $request)
    {
        $query = Student::with(['department', 'user']);

        // Filters
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->date_from) {
            $query->where('enrollment_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->where('enrollment_date', '<=', $request->date_to);
        }

        $students = $query->orderBy('name')->get();
        
        if ($request->export === 'pdf') {
            return $this->exportStudentsPDF($students);
        }
        
        if ($request->export === 'excel') {
            return $this->exportStudentsExcel($students);
        }

        return view('reports.students', compact('students'));
    }

    public function enrollments(Request $request)
    {
        $query = Enrollment::with(['student.user', 'course']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->date_from) {
            $query->where('enrollment_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->where('enrollment_date', '<=', $request->date_to);
        }

        $enrollments = $query->orderBy('enrollment_date', 'desc')->get();
        
        if ($request->export === 'pdf') {
            return $this->exportEnrollmentsPDF($enrollments);
        }
        
        if ($request->export === 'excel') {
            return $this->exportEnrollmentsExcel($enrollments);
        }

        return view('reports.enrollments', compact('enrollments'));
    }

    public function payments(Request $request)
    {
        $query = Payment::with(['student.user']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }
        if ($request->date_from) {
            $query->where('payment_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('payment_date', 'desc')->get();
        
        $totalAmount = $payments->sum('amount');
        $totalPaid = $payments->where('status', 'completed')->sum('amount');
        
        if ($request->export === 'pdf') {
            return $this->exportPaymentsPDF($payments, $totalAmount, $totalPaid);
        }
        
        if ($request->export === 'excel') {
            return $this->exportPaymentsExcel($payments);
        }

        return view('reports.payments', compact('payments', 'totalAmount', 'totalPaid'));
    }

    public function grades(Request $request)
    {
        $query = Grade::with(['student.user', 'course']);

        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->grade) {
            $query->where('grade', $request->grade);
        }
        if ($request->date_from) {
            $query->where('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->where('created_at', '<=', $request->date_to);
        }

        $grades = $query->orderBy('created_at', 'desc')->get();
        
        if ($request->export === 'pdf') {
            return $this->exportGradesPDF($grades);
        }
        
        if ($request->export === 'excel') {
            return $this->exportGradesExcel($grades);
        }

        return view('reports.grades', compact('grades'));
    }

    public function finance(Request $request)
    {
        $dateFrom = $request->date_from ?? Carbon::now()->startOfYear()->toDateString();
        $dateTo = $request->date_to ?? Carbon::now()->endOfYear()->toDateString();

        // Fee collection by month
        $monthlyFees = Fee::select(
            DB::raw('strftime("%Y-%m", due_date) as month'),
            DB::raw('SUM(amount) as total')
        )
        ->whereBetween('due_date', [$dateFrom, $dateTo])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Payment collection by month
        $monthlyPayments = Payment::select(
            DB::raw('strftime("%Y-%m", payment_date) as month'),
            DB::raw('SUM(amount) as total')
        )
        ->whereBetween('payment_date', [$dateFrom, $dateTo])
        ->where('status', 'completed')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $totalFees = Fee::whereBetween('due_date', [$dateFrom, $dateTo])->sum('amount');
        $totalPayments = Payment::whereBetween('payment_date', [$dateFrom, $dateTo])
            ->where('status', 'completed')
            ->sum('amount');
        $outstanding = $totalFees - $totalPayments;

        if ($request->export === 'pdf') {
            return $this->exportFinancePDF($monthlyFees, $monthlyPayments, $totalFees, $totalPayments, $outstanding, $dateFrom, $dateTo);
        }

        return view('reports.finance', compact('monthlyFees', 'monthlyPayments', 'totalFees', 'totalPayments', 'outstanding', 'dateFrom', 'dateTo'));
    }

    // PDF Export Methods
    private function exportStudentsPDF($students)
    {
        $pdf = Pdf::loadView('reports.pdf.students', compact('students'));
        return $pdf->download('students-report-' . date('Y-m-d') . '.pdf');
    }

    private function exportEnrollmentsPDF($enrollments)
    {
        $pdf = Pdf::loadView('reports.pdf.enrollments', compact('enrollments'));
        return $pdf->download('enrollments-report-' . date('Y-m-d') . '.pdf');
    }

    private function exportPaymentsPDF($payments, $totalAmount, $totalPaid)
    {
        $pdf = Pdf::loadView('reports.pdf.payments', compact('payments', 'totalAmount', 'totalPaid'));
        return $pdf->download('payments-report-' . date('Y-m-d') . '.pdf');
    }

    private function exportGradesPDF($grades)
    {
        $pdf = Pdf::loadView('reports.pdf.grades', compact('grades'));
        return $pdf->download('grades-report-' . date('Y-m-d') . '.pdf');
    }

    private function exportFinancePDF($monthlyFees, $monthlyPayments, $totalFees, $totalPayments, $outstanding, $dateFrom, $dateTo)
    {
        $pdf = Pdf::loadView('reports.pdf.finance', compact('monthlyFees', 'monthlyPayments', 'totalFees', 'totalPayments', 'outstanding', 'dateFrom', 'dateTo'));
        return $pdf->download('finance-report-' . date('Y-m-d') . '.pdf');
    }

    // Excel Export Methods (CSV)
    private function exportStudentsExcel($students)
    {
        $headers = ['ID', 'Name', 'Email', 'Student ID', 'Department', 'Status', 'Enrollment Date'];
        $rows = $students->map(function ($student) {
            return [
                $student->id,
                $student->name,
                $student->user?->email,
                $student->student_id,
                $student->department?->name,
                $student->status,
                $student->enrollment_date,
            ];
        });

        return $this->downloadCSV('students-report', $headers, $rows);
    }

    private function exportEnrollmentsExcel($enrollments)
    {
        $headers = ['ID', 'Student', 'Course', 'Status', 'Enrollment Date', 'Approved Date'];
        $rows = $enrollments->map(function ($enrollment) {
            return [
                $enrollment->id,
                $enrollment->student?->name,
                $enrollment->course?->name,
                $enrollment->status,
                $enrollment->enrollment_date,
                $enrollment->approved_date,
            ];
        });

        return $this->downloadCSV('enrollments-report', $headers, $rows);
    }

    private function exportPaymentsExcel($payments)
    {
        $headers = ['ID', 'Student', 'Amount', 'Method', 'Status', 'Payment Date', 'Reference'];
        $rows = $payments->map(function ($payment) {
            return [
                $payment->id,
                $payment->student?->name,
                $payment->amount,
                $payment->payment_method,
                $payment->status,
                $payment->payment_date,
                $payment->reference_number,
            ];
        });

        return $this->downloadCSV('payments-report', $headers, $rows);
    }

    private function exportGradesExcel($grades)
    {
        $headers = ['ID', 'Student', 'Course', 'Grade', 'Score', 'Date'];
        $rows = $grades->map(function ($grade) {
            return [
                $grade->id,
                $grade->student?->name,
                $grade->course?->name,
                $grade->grade,
                $grade->score,
                $grade->created_at->format('Y-m-d'),
            ];
        });

        return $this->downloadCSV('grades-report', $headers, $rows);
    }

    private function downloadCSV($filename, $headers, $rows)
    {
        $callback = function() use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return response()->streamDownload($callback, $filename . '-' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '-' . date('Y-m-d') . '.csv"',
        ]);
    }
}
