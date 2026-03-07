<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'course'])->paginate(10);
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'grade' => 'required',
            'semester' => 'required',
        ]);

        Grade::create($request->all());
        return redirect()->route('grades.index')->with('success', __('Grade created successfully'));
    }

    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'grade' => 'required',
            'semester' => 'required',
        ]);

        $grade->update($request->all());
        return redirect()->route('grades.index')->with('success', __('Grade updated successfully'));
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', __('Grade deleted successfully'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'grades' => 'required|array',
        ]);

        foreach ($request->grades as $gradeData) {
            Grade::updateOrCreate(
                [
                    'student_id' => $gradeData['student_id'],
                    'course_id' => $gradeData['course_id'],
                    'semester' => $gradeData['semester'],
                ],
                ['grade' => $gradeData['grade']]
            );
        }

        return redirect()->route('grades.index')->with('success', __('Grades submitted successfully'));
    }
}
