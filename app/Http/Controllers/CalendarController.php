<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicCalendar;
use App\Models\AcademicYear;
use App\Models\Semester;

class CalendarController extends Controller
{
    /**
     * Display calendar
     */
    public function index(Request $request)
    {
        $query = AcademicCalendar::with(['academicYear', 'semester']);

        // Filter by event type
        if ($request->has('event_type')) {
            $query->byEventType($request->event_type);
        }

        // Filter by year
        if ($request->has('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        // Default: show upcoming events
        $events = $query->active()
            ->orderBy('start_date')
            ->paginate(20);

        $academicYears = AcademicYear::all();
        $eventTypes = ['exam', 'holiday', 'registration', 'lecture', 'event', 'deadline', 'other'];

        return view('calendar.index', compact('events', 'academicYears', 'eventTypes'));
    }

    /**
     * Show single event
     */
    public function show($id)
    {
        $event = AcademicCalendar::with(['academicYear', 'semester'])->find($id);

        if (!$event) {
            return redirect()->route('calendar.index')->with('error', 'Event not found');
        }

        return view('calendar.show', compact('event'));
    }

    /**
     * Create event form
     */
    public function create()
    {
        $academicYears = AcademicYear::all();
        $semesters = Semester::all();
        $eventTypes = ['exam', 'holiday', 'registration', 'lecture', 'event', 'deadline', 'other'];

        return view('calendar.create', compact('academicYears', 'semesters', 'eventTypes'));
    }

    /**
     * Store new event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|in:exam,holiday,registration,lecture,event,deadline,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'is_recurring' => 'nullable|boolean',
            'recurring_type' => 'nullable|in:yearly,semester',
            'is_active' => 'nullable|boolean',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'semester_id' => 'nullable|exists:semesters,id',
        ]);

        AcademicCalendar::create($validated);

        return redirect()->route('calendar.index')->with('success', 'Event created successfully');
    }

    /**
     * Edit event form
     */
    public function edit($id)
    {
        $event = AcademicCalendar::find($id);

        if (!$event) {
            return redirect()->route('calendar.index')->with('error', 'Event not found');
        }

        $academicYears = AcademicYear::all();
        $semesters = Semester::all();
        $eventTypes = ['exam', 'holiday', 'registration', 'lecture', 'event', 'deadline', 'other'];

        return view('calendar.edit', compact('event', 'academicYears', 'semesters', 'eventTypes'));
    }

    /**
     * Update event
     */
    public function update(Request $request, $id)
    {
        $event = AcademicCalendar::find($id);

        if (!$event) {
            return redirect()->route('calendar.index')->with('error', 'Event not found');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|in:exam,holiday,registration,lecture,event,deadline,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'is_recurring' => 'nullable|boolean',
            'recurring_type' => 'nullable|in:yearly,semester',
            'is_active' => 'nullable|boolean',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'semester_id' => 'nullable|exists:semesters,id',
        ]);

        $event->update($validated);

        return redirect()->route('calendar.index')->with('success', 'Event updated successfully');
    }

    /**
     * Delete event
     */
    public function destroy($id)
    {
        $event = AcademicCalendar::find($id);

        if (!$event) {
            return redirect()->route('calendar.index')->with('error', 'Event not found');
        }

        $event->delete();

        return redirect()->route('calendar.index')->with('success', 'Event deleted successfully');
    }

    /**
     * Get events for calendar view (JSON)
     */
    public function events(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $events = AcademicCalendar::active()
            ->where(function ($query) use ($start, $end) {
                if ($start) {
                    $query->where('end_date', '>=', $start);
                }
                if ($end) {
                    $query->where('start_date', '<=', $end);
                }
            })
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date->format('Y-m-d') . ($event->start_time ? 'T' . $event->start_time->format('H:i:s') : ''),
                    'end' => $event->end_date->format('Y-m-d') . ($event->end_time ? 'T' . $event->end_time->format('H:i:s') : ''),
                    'type' => $event->event_type,
                    'location' => $event->location,
                    'url' => route('calendar.show', $event->id),
                ];
            });

        return response()->json($events);
    }
}
