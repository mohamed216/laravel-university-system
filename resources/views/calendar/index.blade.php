@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-alt"></i> Academic Calendar</h1>
        @can('role', 'admin')
        <a href="{{ route('calendar.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Event
        </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Filter by Type</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('calendar.index') }}" class="list-group-item list-group-item-action {{ !request('event_type') ? 'active' : '' }}">
                            All Events
                        </a>
                        @foreach($eventTypes as $type)
                        <a href="{{ route('calendar.index', ['event_type' => $type]) }}" 
                           class="list-group-item list-group-item-action {{ request('event_type') == $type ? 'active' : '' }}">
                            {{ ucfirst($type) }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Upcoming Events</h5>
                </div>
                <div class="card-body">
                    @if($events->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Location</th>
                                        @can('role', 'admin')
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>
                                            <a href="{{ route('calendar.show', $event->id) }}">{{ $event->title }}</a>
                                        </td>
                                        <td>
                                            @switch($event->event_type)
                                                @case('exam')
                                                    <span class="badge bg-danger">Exam</span>
                                                    @break
                                                @case('holiday')
                                                    <span class="badge bg-success">Holiday</span>
                                                    @break
                                                @case('registration')
                                                    <span class="badge bg-info">Registration</span>
                                                    @break
                                                @case('lecture')
                                                    <span class="badge bg-primary">Lecture</span>
                                                    @break
                                                @case('event')
                                                    <span class="badge bg-warning">Event</span>
                                                    @break
                                                @case('deadline')
                                                    <span class="badge bg-secondary">Deadline</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-dark">Other</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $event->start_date->format('M d, Y') }}</td>
                                        <td>{{ $event->end_date->format('M d, Y') }}</td>
                                        <td>{{ $event->location ?? '-' }}</td>
                                        @can('role', 'admin')
                                        <td>
                                            <a href="{{ route('calendar.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('calendar.destroy', $event->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $events->links() }}
                    @else
                        <p class="text-muted">No events found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
