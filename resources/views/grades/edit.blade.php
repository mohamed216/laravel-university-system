@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Grade'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Grade') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Enrollment') }} *</label>
                    <select name="enrollment_id" class="form-select" required>
                        <option value="">Select {{ __('Enrollment') }}</option>
                        @foreach($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" {{ $grade->enrollment_id == $enrollment->id ? 'selected' : '' }}>{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }} - {{ $enrollment->courseSection->course->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Semester') }} *</label>
                    <select name="semester_id" class="form-select" required>
                        <option value="">Select {{ __('Semester') }}</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $grade->semester_id == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Letter Grade') }} *</label>
                    <select name="letter_grade" class="form-select" required>
                        <option value="">Select {{ __('Letter Grade') }}</option>
                        <option value="A+" {{ $grade->letter_grade == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A" {{ $grade->letter_grade == 'A' ? 'selected' : '' }}>A</option>
                        <option value="A-" {{ $grade->letter_grade == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ $grade->letter_grade == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B" {{ $grade->letter_grade == 'B' ? 'selected' : '' }}>B</option>
                        <option value="B-" {{ $grade->letter_grade == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="C+" {{ $grade->letter_grade == 'C+' ? 'selected' : '' }}>C+</option>
                        <option value="C" {{ $grade->letter_grade == 'C' ? 'selected' : '' }}>C</option>
                        <option value="C-" {{ $grade->letter_grade == 'C-' ? 'selected' : '' }}>C-</option>
                        <option value="D+" {{ $grade->letter_grade == 'D+' ? 'selected' : '' }}>D+</option>
                        <option value="D" {{ $grade->letter_grade == 'D' ? 'selected' : '' }}>D</option>
                        <option value="D-" {{ $grade->letter_grade == 'D-' ? 'selected' : '' }}>D-</option>
                        <option value="F" {{ $grade->letter_grade == 'F' ? 'selected' : '' }}>F</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Percentage') }} (%)</label>
                    <input type="number" name="percentage" class="form-control" step="0.01" min="0" max="100" value="{{ $grade->percentage }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Grade Points') }}</label>
                    <input type="number" name="grade_points" class="form-control" step="0.01" min="0" max="4" value="{{ $grade->grade_points }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Submission Date') }}</label>
                    <input type="date" name="submission_date" class="form-control" value="{{ $grade->submission_date }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Notes') }}</label>
                    <textarea name="notes" class="form-control" rows="2">{{ $grade->notes }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('grades.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
