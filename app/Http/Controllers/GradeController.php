<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['enrollment.student', 'enrollment.courseSection', 'semester'])->paginate(10);
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'letter_grade' => 'required',
            'semester_id' => 'required|exists:semesters,id',
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
            'enrollment_id' => 'required|exists:enrollments,id',
            'letter_grade' => 'required',
            'semester_id' => 'required|exists:semesters,id',
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
                    'enrollment_id' => $gradeData['enrollment_id'],
                    'semester_id' => $gradeData['semester_id'],
                ],
                ['letter_grade' => $gradeData['letter_grade']]
            );
        }

        return redirect()->route('grades.index')->with('success', __('Grades submitted successfully'));
    }
}
