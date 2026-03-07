@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $event->title }}</h4>
                    <span class="badge bg-{{ $event->event_type == 'exam' ? 'danger' : ($event->event_type == 'holiday' ? 'success' : 'info') }}">
                        {{ ucfirst($event->event_type) }}
                    </span>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Title (English)</dt>
                        <dd class="col-sm-8">{{ $event->title_en }}</dd>

                        <dt class="col-sm-4">Description</dt>
                        <dd class="col-sm-8">{{ $event->description ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Start Date</dt>
                        <dd class="col-sm-8">{{ $event->start_date->format('F d, Y') }}</dd>

                        <dt class="col-sm-4">End Date</dt>
                        <dd class="col-sm-8">{{ $event->end_date->format('F d, Y') }}</dd>

                        @if($event->start_time)
                        <dt class="col-sm-4">Start Time</dt>
                        <dd class="col-sm-8">{{ $event->start_time->format('h:i A') }}</dd>
                        @endif

                        @if($event->end_time)
                        <dt class="col-sm-4">End Time</dt>
                        <dd class="col-sm-8">{{ $event->end_time->format('h:i A') }}</dd>
                        @endif

                        <dt class="col-sm-4">Location</dt>
                        <dd class="col-sm-8">{{ $event->location ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-{{ $event->is_active ? 'success' : 'secondary' }}">
                                {{ $event->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>

                        @if($event->academicYear)
                        <dt class="col-sm-4">Academic Year</dt>
                        <dd class="col-sm-8">{{ $event->academicYear->name }}</dd>
                        @endif

                        @if($event->semester)
                        <dt class="col-sm-4">Semester</dt>
                        <dd class="col-sm-8">{{ $event->semester->name }}</dd>
                        @endif
                    </dl>

                    <div class="d-flex gap-2 mt-4">
                        @can('role', 'admin')
                        <a href="{{ route('calendar.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('calendar.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endcan
                        <a href="{{ route('calendar.index') }}" class="btn btn-secondary">Back to Calendar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
