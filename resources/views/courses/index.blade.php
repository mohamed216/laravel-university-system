@extends('layouts.app')

@section('title', __('Courses'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Courses') }}</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Course') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="department_id" class="form-select">
                    <option value="">{{ __('Department') }}</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="level" class="form-select">
                    <option value="">{{ __('Level') }}</option>
                    <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                    <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                    <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                    <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
                    <option value="5" {{ request('level') == '5' ? 'selected' : '' }}>Level 5</option>
                    <option value="6" {{ request('level') == '6' ? 'selected' : '' }}>Level 6</option>
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
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Department') }}</th>
                    <th>{{ __('Credits') }}</th>
                    <th>{{ __('Hours') }}</th>
                    <th>{{ __('Level') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->department->name ?? '-' }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>{{ $course->total_hours }}</td>
                    <td>{{ $course->level }}</td>
                    <td>
                        <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }}">
                            {{ $course->is_active ? __('Active') : __('Inactive') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
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
                    <td colspan="8" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $courses->links() }}
    </div>
</div>
@endsection
