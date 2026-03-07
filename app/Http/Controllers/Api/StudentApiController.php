<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentApiController extends Controller
{
    /**
     * List all students
     */
    public function index(Request $request)
    {
        $query = Student::with(['department', 'academicYear']);

        // Filter by department
        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by level
        if ($request->has('level')) {
            $query->where('current_level', $request->level);
        }

        // Search by name or student_id
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        $students = $query->paginate($request->get('per_page', 15));

        return response()->json($students);
    }

    /**
     * Show single student
     */
    public function show($id)
    {
        $student = Student::with(['department', 'academicYear', 'user'])->find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    /**
     * Create new student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students',
            'first_name' => 'required|string|max:255',
            'first_name_en' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'current_level' => 'nullable|integer|min:1|max:8',
            'status' => 'nullable|in:new,active,on_probation,suspended,graduated,withdrawn',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'student',
        ]);

        // Create student
        $student = Student::create([
            'user_id' => $user->id,
            'student_id' => $validated['student_id'],
            'first_name' => $validated['first_name'],
            'first_name_en' => $validated['first_name_en'],
            'last_name' => $validated['last_name'],
            'last_name_en' => $validated['last_name_en'],
            'department_id' => $validated['department_id'],
            'phone' => $validated['phone'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'nationality' => $validated['nationality'] ?? null,
            'address' => $validated['address'] ?? null,
            'current_level' => $validated['current_level'] ?? 1,
            'status' => $validated['status'] ?? 'new',
            'admission_date' => now(),
        ]);

        return response()->json($student->load(['department', 'user']), 201);
    }

    /**
     * Update student
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'first_name_en' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'last_name_en' => 'sometimes|string|max:255',
            'department_id' => 'sometimes|exists:departments,id',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'current_level' => 'nullable|integer|min:1|max:8',
            'status' => 'nullable|in:new,active,on_probation,suspended,graduated,withdrawn',
        ]);

        $student->update($validated);

        return response()->json($student->load(['department', 'user']));
    }

    /**
     * Delete student
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Delete associated user
        if ($student->user) {
            $student->user->delete();
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }

    /**
     * Get student enrollments
     */
    public function enrollments($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $enrollments = $student->enrollments()
            ->with(['courseSection.course', 'semester'])
            ->get();

        return response()->json($enrollments);
    }

    /**
     * Get student grades
     */
    public function grades($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $grades = $student->enrollments()
            ->with(['courseSection.course', 'semester', 'grades'])
            ->get()
            ->pluck('grades')
            ->flatten();

        return response()->json($grades);
    }
}
