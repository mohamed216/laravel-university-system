@extends('layouts.app')

@section('title', __('Enrollments'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Enrollments') }}</h2>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="semester_id" class="form-select">
                    <option value="">{{ __('Semester') }}</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">{{ __('Status') }}</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    <option value="dropped" {{ request('status') == 'dropped' ? 'selected' : '' }}>{{ __('Dropped') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('Student') }}</th>
                    <th>{{ __('Course Section') }}</th>
                    <th>{{ __('Semester') }}</th>
                    <th>{{ __('Enrollment Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</td>
                    <td>{{ $enrollment->courseSection->course->name ?? '-' }} - {{ $enrollment->courseSection->section_number ?? '' }}</td>
                    <td>{{ $enrollment->semester->name ?? '-' }}</td>
                    <td>{{ $enrollment->enrollment_date }}</td>
                    <td>
                        @switch($enrollment->status)
                            @case('pending')
                                <span class="badge bg-warning">{{ __('Pending') }}</span>
                                @break
                            @case('approved')
                                <span class="badge bg-info">{{ __('Approved') }}</span>
                                @break
                            @case('completed')
                                <span class="badge bg-success">{{ __('Completed') }}</span>
                                @break
                            @case('dropped')
                                <span class="badge bg-danger">{{ __('Dropped') }}</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ $enrollment->status }}</span>
                        @endswitch
                    </td>
                    <td>
                        @if($enrollment->status == 'pending')
                            <form action="{{ route('enrollments.approve', $enrollment) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                        @endif
                        @if($enrollment->status == 'approved')
                            <form action="{{ route('enrollments.drop', $enrollment) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Drop this enrollment?')">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $enrollments->links() }}
    </div>
</div>
@endsection
