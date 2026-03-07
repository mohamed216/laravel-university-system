<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'courseSection'])->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_section_id' => 'required|exists:course_sections,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        Attendance::create($request->all());
        return redirect()->route('attendances.index')->with('success', __('Attendance created successfully'));
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_section_id' => 'required|exists:course_sections,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $attendance->update($request->all());
        return redirect()->route('attendances.index')->with('success', __('Attendance updated successfully'));
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', __('Attendance deleted successfully'));
    }

    public function mark(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_section_id' => 'required|exists:course_sections,id',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        Attendance::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'course_section_id' => $request->course_section_id,
                'date' => $request->date,
            ],
            ['status' => $request->status]
        );

        return redirect()->route('attendances.index')->with('success', __('Attendance marked successfully'));
    }
}
