<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification as AppNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display user notifications
     */
    public function index(Request $request)
    {
        $query = AppNotification::with('creator')
            ->where('user_id', Auth::id());

        // Filter by type
        if ($request->has('type')) {
            $query->byType($request->type);
        }

        // Filter read/unread
        if ($request->has('read')) {
            if ($request->boolean('read')) {
                $query->where('is_read', true);
            } else {
                $query->where('is_read', false);
            }
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get unread count
        $unreadCount = AppNotification::where('user_id', Auth::id())
            ->unread()
            ->count();

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = AppNotification::where('user_id', Auth::id())->find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->markAsRead();

        return response()->json(['message' => 'Notification marked as read']);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        AppNotification::where('user_id', Auth::id())
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json(['message' => 'All notifications marked as read']);
    }

    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $notification = AppNotification::where('user_id', Auth::id())->find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }

    /**
     * Get unread notifications (for API/AJAX)
     */
    public function getUnread()
    {
        $notifications = AppNotification::where('user_id', Auth::id())
            ->unread()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $unreadCount = $notifications->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Create notification (admin only)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,success,error',
            'icon' => 'nullable|string|max:50',
            'link' => 'nullable|url',
        ]);

        $validated['created_by'] = Auth::id();

        $notification = AppNotification::create($validated);

        return response()->json($notification, 201);
    }

    /**
     * Send notification to multiple users
     */
    public function broadcast(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,success,error',
            'icon' => 'nullable|string|max:50',
            'link' => 'nullable|url',
        ]);

        $notifications = [];
        foreach ($validated['user_ids'] as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'title' => $validated['title'],
                'message' => $validated['message'],
                'type' => $validated['type'],
                'icon' => $validated['icon'] ?? null,
                'link' => $validated['link'] ?? null,
                'created_by' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        AppNotification::insert($notifications);

        return response()->json(['message' => 'Notifications sent successfully', 'count' => count($notifications)]);
    }
}
