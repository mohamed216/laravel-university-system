<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineLecture;
use App\Models\CourseSection;
use App\Models\Professor;

class OnlineLectureController extends Controller
{
    public function index(Request $request)
    {
        $query = OnlineLecture::with(['courseSection.course', 'professor']);
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->course_section_id) {
            $query->where('course_section_id', $request->course_section_id);
        }
        
        $lectures = $query->paginate(15);
        $courseSections = CourseSection::with('course')->get();
        
        return view('online_lectures.index', compact('lectures', 'courseSections'));
    }

    public function create()
    {
        $courseSections = CourseSection::with(['course', 'professor'])->get();
        $professors = Professor::all();
        return view('online_lectures.create', compact('courseSections', 'professors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_section_id' => 'required|exists:course_sections,id',
            'professor_id' => 'required|exists:professors,id',
            'title' => 'required|string|max:255',
            'meeting_link' => 'nullable|url',
            'video_url' => 'nullable|url',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        OnlineLecture::create($request->all());
        return redirect()->route('online-lectures.index')->with('success', __('Online lecture created successfully'));
    }

    public function show(OnlineLecture $onlineLecture)
    {
        $onlineLecture->load(['courseSection.course', 'professor', 'attendances.student']);
        return view('online_lectures.show', compact('onlineLecture'));
    }

    public function edit(OnlineLecture $onlineLecture)
    {
        $courseSections = CourseSection::with(['course', 'professor'])->get();
        $professors = Professor::all();
        return view('online_lectures.edit', compact('onlineLecture', 'courseSections', 'professors'));
    }

    public function update(Request $request, OnlineLecture $onlineLecture)
    {
        $request->validate([
            'course_section_id' => 'required|exists:course_sections,id',
            'professor_id' => 'required|exists:professors,id',
            'title' => 'required|string|max:255',
            'meeting_link' => 'nullable|url',
            'video_url' => 'nullable|url',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        $onlineLecture->update($request->all());
        return redirect()->route('online-lectures.index')->with('success', __('Online lecture updated successfully'));
    }

    public function destroy(OnlineLecture $onlineLecture)
    {
        $onlineLecture->delete();
        return redirect()->route('online-lectures.index')->with('success', __('Online lecture deleted successfully'));
    }

    public function startLive(OnlineLecture $onlineLecture)
    {
        $onlineLecture->update(['status' => 'live']);
        return redirect()->back()->with('success', __('Lecture is now live'));
    }

    public function endLive(OnlineLecture $onlineLecture)
    {
        $onlineLecture->update(['status' => 'completed']);
        return redirect()->back()->with('success', __('Lecture ended'));
    }
}
