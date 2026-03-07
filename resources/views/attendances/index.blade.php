@extends('layouts.app')

@section('title', __('Attendances'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Attendances') }}</h2>
    <a href="{{ route('attendances.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Attendance') }}
    </a>
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
                    <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>{{ __('Present') }}</option>
                    <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>{{ __('Absent') }}</option>
                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>{{ __('Late') }}</option>
                    <option value="excused" {{ request('status') == 'excused' ? 'selected' : '' }}>{{ __('Excused') }}</option>
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
                    <th>{{ __('Course') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->student->first_name ?? '' }} {{ $attendance->student->last_name ?? '' }}</td>
                    <td>{{ $attendance->courseSection->course->name ?? '-' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>
                        @switch($attendance->status)
                            @case('present')
                                <span class="badge bg-success">{{ __('Present') }}</span>
                                @break
                            @case('absent')
                                <span class="badge bg-danger">{{ __('Absent') }}</span>
                                @break
                            @case('late')
                                <span class="badge bg-warning">{{ __('Late') }}</span>
                                @break
                            @case('excused')
                                <span class="badge bg-info">{{ __('Excused') }}</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ $attendance->status }}</span>
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('attendances.show', $attendance) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('attendances.edit', $attendance) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $attendances->links() }}
    </div>
</div>
@endsection
