@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-bell"></i> Notifications</h1>
        <button class="btn btn-primary" onclick="markAllAsRead()">
            <i class="fas fa-check-double"></i> Mark All as Read
        </button>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('read') ? 'active' : '' }}" href="{{ route('notifications.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('read') === 'false' ? 'active' : '' }}" href="{{ route('notifications.index', ['read' => 'false']) }}">Unread</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('read') === 'true' ? 'active' : '' }}" href="{{ route('notifications.index', ['read' => 'true']) }}">Read</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="list-group">
                            @foreach($notifications as $notification)
                            <div class="list-group-item list-group-item-action {{ !$notification->is_read ? 'bg-light' : '' }}" 
                                 id="notification-{{ $notification->id }}">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="mb-1">
                                        @switch($notification->type)
                                            @case('info')
                                                <i class="fas fa-info-circle text-info"></i>
                                                @break
                                            @case('warning')
                                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                                @break
                                            @case('success')
                                                <i class="fas fa-check-circle text-success"></i>
                                                @break
                                            @case('error')
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @break
                                        @endswitch
                                        <strong>{{ $notification->title }}</strong>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-primary">New</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ $notification->message }}</p>
                                <div class="d-flex gap-2">
                                    @if($notification->link)
                                    <a href="{{ $notification->link }}" class="btn btn-sm btn-primary">View</a>
                                    @endif
                                    @if(!$notification->is_read)
                                    <button class="btn btn-sm btn-outline-secondary" onclick="markAsRead({{ $notification->id }})">Mark as Read</button>
                                    @endif
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteNotification({{ $notification->id }})">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $notifications->links() }}
                    @else
                        <p class="text-muted">No notifications</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function markAsRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    });
}

function markAllAsRead() {
    fetch('/notifications/read-all', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    });
}

function deleteNotification(id) {
    if (confirm('Are you sure you want to delete this notification?')) {
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                document.getElementById(`notification-${id}`).remove();
            }
        });
    }
}
</script>
@endpush
@endsection
