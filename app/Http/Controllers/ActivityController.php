<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('user');

        // Filters
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->action) {
            $query->where('action', $request->action);
        }
        if ($request->entity_type) {
            $query->where('entity_type', $request->entity_type);
        }
        if ($request->date_from) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }
        if ($request->date_to) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        $activities = $query->orderBy('created_at', 'desc')->paginate(50);
        
        // Get unique action types for filter
        $actions = Activity::distinct()->pluck('action');
        
        return view('activities.index', compact('activities', 'actions'));
    }

    public function show(Activity $activity)
    {
        $activity->load('user');
        return view('activities.show', compact('activity'));
    }

    public function userActivity(Request $request)
    {
        $userId = $request->user_id ?? auth()->id();
        
        $activities = Activity::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('activities.user', compact('activities'));
    }
}
