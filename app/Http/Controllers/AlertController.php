<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
    /**
     * Display all alerts (admin view)
     */
    public function index(Request $request)
    {
        $query = Alert::with('creator');

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } else {
                $query->where('is_active', false);
            }
        }

        $alerts = $query->orderBy('display_order')->paginate(20);

        return view('alerts.index', compact('alerts'));
    }

    /**
     * Create alert form
     */
    public function create()
    {
        $alertTypes = ['info', 'warning', 'danger', 'success', 'maintenance'];
        $displayPositions = ['top', 'bottom', 'banner'];

        return view('alerts.create', compact('alertTypes', 'displayPositions'));
    }

    /**
     * Store new alert
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger,success,maintenance',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_dismissible' => 'nullable|boolean',
            'display_position' => 'nullable|in:top,bottom,banner',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['created_by'] = auth()->id();

        Alert::create($validated);

        return redirect()->route('alerts.index')->with('success', 'Alert created successfully');
    }

    /**
     * Edit alert form
     */
    public function edit($id)
    {
        $alert = Alert::find($id);

        if (!$alert) {
            return redirect()->route('alerts.index')->with('error', 'Alert not found');
        }

        $alertTypes = ['info', 'warning', 'danger', 'success', 'maintenance'];
        $displayPositions = ['top', 'bottom', 'banner'];

        return view('alerts.edit', compact('alert', 'alertTypes', 'displayPositions'));
    }

    /**
     * Update alert
     */
    public function update(Request $request, $id)
    {
        $alert = Alert::find($id);

        if (!$alert) {
            return redirect()->route('alerts.index')->with('error', 'Alert not found');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger,success,maintenance',
            'is_active' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_dismissible' => 'nullable|boolean',
            'display_position' => 'nullable|in:top,bottom,banner',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $alert->update($validated);

        return redirect()->route('alerts.index')->with('success', 'Alert updated successfully');
    }

    /**
     * Delete alert
     */
    public function destroy($id)
    {
        $alert = Alert::find($id);

        if (!$alert) {
            return redirect()->route('alerts.index')->with('error', 'Alert not found');
        }

        $alert->delete();

        return redirect()->route('alerts.index')->with('success', 'Alert deleted successfully');
    }

    /**
     * Toggle alert status
     */
    public function toggle($id)
    {
        $alert = Alert::find($id);

        if (!$alert) {
            return response()->json(['message' => 'Alert not found'], 404);
        }

        $alert->update(['is_active' => !$alert->is_active]);

        return response()->json(['message' => 'Alert status toggled', 'is_active' => $alert->is_active]);
    }

    /**
     * Get active alerts (for frontend)
     */
    public function getActive()
    {
        $alerts = Alert::active()
            ->orderBy('display_order')
            ->get();

        return response()->json($alerts);
    }

    /**
     * Get alerts by position
     */
    public function getByPosition($position)
    {
        $alerts = Alert::active()
            ->byPosition($position)
            ->orderBy('display_order')
            ->get();

        return response()->json($alerts);
    }
}
