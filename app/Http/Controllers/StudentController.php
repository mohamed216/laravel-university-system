<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Department;
use App\Models\AcademicYear;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('department');
        
        if ($request->search) {
            $query->where('first_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%")
                ->orWhere('student_id', 'like', "%{$request->search}%");
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }
        
        $students = $query->paginate(15);
        $departments = Department::all();
        
        return view('students.index', compact('students', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('students.create', compact('departments', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => 'required|unique:students',
            'department_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'academic_year_id' => $request->academic_year_id,
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'first_name_en' => $request->first_name_en,
            'last_name' => $request->last_name,
            'last_name_en' => $request->last_name_en,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'national_id' => $request->national_id,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'status' => 'new',
        ]);

        return redirect()->route('students.index')->with('success', __('Student created successfully'));
    }

    public function show(Student $student)
    {
        $student->load(['department', 'enrollments', 'payments', 'libraryTransactions']);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('students.edit', compact('student', 'departments', 'academicYears'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'department_id' => 'required',
        ]);

        $student->update($request->all());
        
        if ($student->user) {
            $student->user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
            ]);
        }

        return redirect()->route('students.index')->with('success', __('Student updated successfully'));
    }

    public function destroy(Student $student)
    {
        if ($student->user) {
            $student->user->delete();
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', __('Student deleted successfully'));
    }
}
