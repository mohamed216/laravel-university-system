<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('department');
        
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }
        
        if ($request->level) {
            $query->where('level', $request->level);
        }
        
        $courses = $query->paginate(15);
        $departments = Department::all();
        
        return view('courses.index', compact('courses', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        $courses = Course::all();
        return view('courses.create', compact('departments', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required',
            'department_id' => 'required',
            'credits' => 'required|integer|min:1',
        ]);

        $course = Course::create($request->all());
        
        if ($request->prerequisites) {
            $course->prerequisites()->attach($request->prerequisites);
        }

        return redirect()->route('courses.index')->with('success', __('Course created successfully'));
    }

    public function show(Course $course)
    {
        $course->load('department', 'prerequisites', 'courseSections');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        $courses = Course::where('id', '!=', $course->id)->get();
        return view('courses.edit', compact('course', 'departments', 'courses'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required',
            'department_id' => 'required',
        ]);

        $course->update($request->all());
        
        if ($request->prerequisites) {
            $course->prerequisites()->sync($request->prerequisites);
        }

        return redirect()->route('courses.index')->with('success', __('Course updated successfully'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', __('Course deleted successfully'));
    }
}
