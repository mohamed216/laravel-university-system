@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Attendance'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Attendance') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student') }} *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select {{ __('Student') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Course Section') }} *</label>
                    <select name="course_section_id" class="form-select" required>
                        <option value="">Select {{ __('Course Section') }}</option>
                        @foreach($courseSections as $section)
                            <option value="{{ $section->id }}">{{ $section->course->name ?? '' }} - Section {{ $section->section_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Date') }} *</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Status') }} *</label>
                    <select name="status" class="form-select" required>
                        <option value="present">{{ __('Present') }}</option>
                        <option value="absent">{{ __('Absent') }}</option>
                        <option value="late">{{ __('Late') }}</option>
                        <option value="excused">{{ __('Excused') }}</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Notes') }}</label>
                    <textarea name="notes" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('attendances.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
