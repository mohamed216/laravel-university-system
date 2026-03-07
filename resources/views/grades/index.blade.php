@extends('layouts.app')

@section('title', __('Grades'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Grades') }}</h2>
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
                <select name="letter_grade" class="form-select">
                    <option value="">{{ __('Grade') }}</option>
                    <option value="A+" {{ request('letter_grade') == 'A+' ? 'selected' : '' }}>A+</option>
                    <option value="A" {{ request('letter_grade') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="A-" {{ request('letter_grade') == 'A-' ? 'selected' : '' }}>A-</option>
                    <option value="B+" {{ request('letter_grade') == 'B+' ? 'selected' : '' }}>B+</option>
                    <option value="B" {{ request('letter_grade') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="B-" {{ request('letter_grade') == 'B-' ? 'selected' : '' }}>B-</option>
                    <option value="C+" {{ request('letter_grade') == 'C+' ? 'selected' : '' }}>C+</option>
                    <option value="C" {{ request('letter_grade') == 'C' ? 'selected' : '' }}>C</option>
                    <option value="C-" {{ request('letter_grade') == 'C-' ? 'selected' : '' }}>C-</option>
                    <option value="D+" {{ request('letter_grade') == 'D+' ? 'selected' : '' }}>D+</option>
                    <option value="D" {{ request('letter_grade') == 'D' ? 'selected' : '' }}>D</option>
                    <option value="D-" {{ request('letter_grade') == 'D-' ? 'selected' : '' }}>D-</option>
                    <option value="F" {{ request('letter_grade') == 'F' ? 'selected' : '' }}>F</option>
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
                    <th>{{ __('Semester') }}</th>
                    <th>{{ __('Letter Grade') }}</th>
                    <th>{{ __('Percentage') }} (%)</th>
                    <th>{{ __('Grade Points') }}</th>
                    <th>{{ __('Submission Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                <tr>
                    <td>{{ $grade->enrollment->student->first_name ?? '' }} {{ $grade->enrollment->student->last_name ?? '' }}</td>
                    <td>{{ $grade->enrollment->courseSection->course->name ?? '-' }}</td>
                    <td>{{ $grade->semester->name ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $grade->letter_grade >= 'C' ? 'success' : 'danger' }}">
                            {{ $grade->letter_grade }}
                        </span>
                    </td>
                    <td>{{ number_format($grade->percentage, 2) }}%</td>
                    <td>{{ number_format($grade->grade_points, 2) }}</td>
                    <td>{{ $grade->submission_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $grades->links() }}
    </div>
</div>
@endsection
