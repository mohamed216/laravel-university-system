<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSection;

class CourseApiController extends Controller
{
    /**
     * List all courses
     */
    public function index(Request $request)
    {
        $query = Course::with(['department']);

        // Filter by department
        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by level
        if ($request->has('level')) {
            $query->where('level', $request->level);
        }

        // Filter by active status
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // Search by name or code
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $courses = $query->paginate($request->get('per_page', 15));

        return response()->json($courses);
    }

    /**
     * Show single course
     */
    public function show($id)
    {
        $course = Course::with(['department', 'prerequisites', 'prerequisiteFor'])->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course);
    }

    /**
     * Create new course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'credits' => 'nullable|integer|min:1|max:10',
            'hours_lecture' => 'nullable|integer|min:0',
            'hours_lab' => 'nullable|integer|min:0',
            'hours_tutorial' => 'nullable|integer|min:0',
            'level' => 'nullable|in:1,2,3,4,5,6,7,8',
            'is_active' => 'nullable|boolean',
            'prerequisites' => 'nullable|array',
            'prerequisites.*' => 'exists:courses,id',
        ]);

        // Create course
        $course = Course::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'name_en' => $validated['name_en'],
            'department_id' => $validated['department_id'],
            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'credits' => $validated['credits'] ?? 3,
            'hours_lecture' => $validated['hours_lecture'] ?? 3,
            'hours_lab' => $validated['hours_lab'] ?? 0,
            'hours_tutorial' => $validated['hours_tutorial'] ?? 0,
            'level' => $validated['level'] ?? '1',
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Attach prerequisites
        if (!empty($validated['prerequisites'])) {
            $course->prerequisites()->attach($validated['prerequisites']);
        }

        return response()->json($course->load(['department', 'prerequisites']), 201);
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $validated = $request->validate([
            'code' => 'sometimes|unique:courses,code,' . $id,
            'name' => 'sometimes|string|max:255',
            'name_en' => 'sometimes|string|max:255',
            'department_id' => 'sometimes|exists:departments,id',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'credits' => 'nullable|integer|min:1|max:10',
            'hours_lecture' => 'nullable|integer|min:0',
            'hours_lab' => 'nullable|integer|min:0',
            'hours_tutorial' => 'nullable|integer|min:0',
            'level' => 'nullable|in:1,2,3,4,5,6,7,8',
            'is_active' => 'nullable|boolean',
            'prerequisites' => 'nullable|array',
            'prerequisites.*' => 'exists:courses,id',
        ]);

        $course->update($validated);

        // Update prerequisites if provided
        if (isset($validated['prerequisites'])) {
            $course->prerequisites()->sync($validated['prerequisites']);
        }

        return response()->json($course->load(['department', 'prerequisites']));
    }

    /**
     * Delete course
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }

    /**
     * Get course sections
     */
    public function sections($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $sections = $course->courseSections()
            ->with(['semester', 'professor'])
            ->get();

        return response()->json($sections);
    }

    /**
     * Get course enrollments
     */
    public function enrollments($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $enrollments = $course->courseSections()
            ->with(['enrollments.student'])
            ->get()
            ->pluck('enrollments')
            ->flatten();

        return response()->json($enrollments);
    }
}
