<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\User;

class ProfessorApiController extends Controller
{
    /**
     * List all professors
     */
    public function index(Request $request)
    {
        $query = Professor::with(['department']);

        // Filter by department
        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by degree
        if ($request->has('degree')) {
            $query->where('degree', $request->degree);
        }

        // Search by name or employee_id
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%");
            });
        }

        $professors = $query->paginate($request->get('per_page', 15));

        return response()->json($professors);
    }

    /**
     * Show single professor
     */
    public function show($id)
    {
        $professor = Professor::with(['department', 'user'])->find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        return response()->json($professor);
    }

    /**
     * Create new professor
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|unique:professors',
            'first_name' => 'required|string|max:255',
            'first_name_en' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:100',
            'qualifications' => 'nullable|string',
            'office' => 'nullable|string|max:50',
            'office_hours' => 'nullable|string',
            'status' => 'nullable|in:active,on_leave,retired',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'professor',
        ]);

        // Create professor
        $professor = Professor::create([
            'user_id' => $user->id,
            'employee_id' => $validated['employee_id'],
            'first_name' => $validated['first_name'],
            'first_name_en' => $validated['first_name_en'],
            'last_name' => $validated['last_name'],
            'last_name_en' => $validated['last_name_en'],
            'department_id' => $validated['department_id'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'degree' => $validated['degree'] ?? null,
            'qualifications' => $validated['qualifications'] ?? null,
            'office' => $validated['office'] ?? null,
            'office_hours' => $validated['office_hours'] ?? null,
            'status' => $validated['status'] ?? 'active',
        ]);

        return response()->json($professor->load(['department', 'user']), 201);
    }

    /**
     * Update professor
     */
    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'first_name_en' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'last_name_en' => 'sometimes|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:100',
            'qualifications' => 'nullable|string',
            'office' => 'nullable|string|max:50',
            'office_hours' => 'nullable|string',
            'status' => 'nullable|in:active,on_leave,retired',
        ]);

        $professor->update($validated);

        return response()->json($professor->load(['department', 'user']));
    }

    /**
     * Delete professor
     */
    public function destroy($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        // Delete associated user
        if ($professor->user) {
            $professor->user->delete();
        }

        $professor->delete();

        return response()->json(['message' => 'Professor deleted successfully']);
    }

    /**
     * Get professor courses
     */
    public function courses($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        $courses = $professor->courseSections()
            ->with(['course', 'semester'])
            ->get()
            ->pluck('course');

        return response()->json($courses);
    }
}
