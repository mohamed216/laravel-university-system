@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Enrollment'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Enrollment') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student') }} *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select {{ __('Student') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Course Section') }} *</label>
                    <select name="course_section_id" class="form-select" required>
                        <option value="">Select {{ __('Course Section') }}</option>
                        @foreach($courseSections as $section)
                            <option value="{{ $section->id }}" {{ $enrollment->course_section_id == $section->id ? 'selected' : '' }}>{{ $section->course->name ?? '' }} - Section {{ $section->section_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Semester') }} *</label>
                    <select name="semester_id" class="form-select" required>
                        <option value="">Select {{ __('Semester') }}</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $enrollment->semester_id == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Enrollment Date') }}</label>
                    <input type="date" name="enrollment_date" class="form-control" value="{{ $enrollment->enrollment_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $enrollment->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                        <option value="approved" {{ $enrollment->status == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                        <option value="completed" {{ $enrollment->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                        <option value="dropped" {{ $enrollment->status == 'dropped' ? 'selected' : '' }}>{{ __('Dropped') }}</option>
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
