<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        return view('enrollments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester' => 'required',
        ]);

        Enrollment::create($request->all());
        return redirect()->route('enrollments.index')->with('success', __('Enrollment created successfully'));
    }

    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        return view('enrollments.edit', compact('enrollment'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester' => 'required',
        ]);

        $enrollment->update($request->all());
        return redirect()->route('enrollments.index')->with('success', __('Enrollment updated successfully'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', __('Enrollment deleted successfully'));
    }

    public function approve(Request $request, Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'approved']);
        return redirect()->route('enrollments.index')->with('success', __('Enrollment approved successfully'));
    }

    public function drop(Request $request, Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'dropped']);
        return redirect()->route('enrollments.index')->with('success', __('Enrollment dropped successfully'));
    }
}
