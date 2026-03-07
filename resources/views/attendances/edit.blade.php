@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Attendance'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Attendance') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.update', $attendance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student') }} *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select {{ __('Student') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $attendance->student_id == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Course Section') }} *</label>
                    <select name="course_section_id" class="form-select" required>
                        <option value="">Select {{ __('Course Section') }}</option>
                        @foreach($courseSections as $section)
                            <option value="{{ $section->id }}" {{ $attendance->course_section_id == $section->id ? 'selected' : '' }}>{{ $section->course->name ?? '' }} - Section {{ $section->section_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Date') }} *</label>
                    <input type="date" name="date" class="form-control" value="{{ $attendance->date }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Status') }} *</label>
                    <select name="status" class="form-select" required>
                        <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>{{ __('Present') }}</option>
                        <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>{{ __('Absent') }}</option>
                        <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>{{ __('Late') }}</option>
                        <option value="excused" {{ $attendance->status == 'excused' ? 'selected' : '' }}>{{ __('Excused') }}</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Notes') }}</label>
                    <textarea name="notes" class="form-control" rows="2">{{ $attendance->notes }}</textarea>
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
