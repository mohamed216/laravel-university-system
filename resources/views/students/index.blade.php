@extends('layouts.app')

@section('title', __('Students'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Students') }}</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Student') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">{{ __('Status') }}</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                    <option value="on_probation" {{ request('status') == 'on_probation' ? 'selected' : '' }}>On Probation</option>
                    <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                    <option value="withdrawn" {{ request('status') == 'withdrawn' ? 'selected' : '' }}>{{ __('Withdrawn') }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="department_id" class="form-select">
                    <option value="">{{ __('Department') }}</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
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
                    <th>{{ __('Student ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Department') }}</th>
                    <th>{{ __('Level') }}</th>
                    <th>{{ __('GPA') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->department->name ?? '-' }}</td>
                    <td>{{ $student->current_level }}</td>
                    <td>{{ number_format($student->gpa, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'new' ? 'primary' : 'secondary') }}">
                            {{ __($student->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
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
                    <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
</div>
@endsection
