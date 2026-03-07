@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Student'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Student') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (Arabic) *</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (English)</label>
                    <input type="text" name="first_name_en" class="form-control" value="{{ $student->first_name_en }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (Arabic) *</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (English)</label>
                    <input type="text" name="last_name_en" class="form-control" value="{{ $student->last_name_en }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student ID') }} *</label>
                    <input type="text" name="student_id" class="form-control" value="{{ $student->student_id }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department') }} *</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $student->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email') }} *</label>
                    <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" placeholder="{{ __('Leave blank to keep current password') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Gender') }}</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Birth Date') }}</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ $student->birth_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('National ID') }}</label>
                    <input type="text" name="national_id" class="form-control" value="{{ $student->national_id }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Nationality') }}</label>
                    <input type="text" name="nationality" class="form-control" value="{{ $student->nationality }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Level') }}</label>
                    <input type="number" name="current_level" class="form-control" value="{{ $student->current_level }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('GPA') }}</label>
                    <input type="number" name="gpa" class="form-control" step="0.01" value="{{ $student->gpa }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="new" {{ $student->status == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                        <option value="on_probation" {{ $student->status == 'on_probation' ? 'selected' : '' }}>On Probation</option>
                        <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                        <option value="withdrawn" {{ $student->status == 'withdrawn' ? 'selected' : '' }}>{{ __('Withdrawn') }}</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Address') }}</label>
                    <textarea name="address" class="form-control" rows="2">{{ $student->address }}</textarea>
                </div>
                <hr>
                <h6 class="mb-3">{{ __('Guardian') }} {{ __('Information') }}</h6>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Name') }}</label>
                    <input type="text" name="guardian_name" class="form-control" value="{{ $student->guardian_name }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Phone') }}</label>
                    <input type="text" name="guardian_phone" class="form-control" value="{{ $student->guardian_phone }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Relation') }}</label>
                    <input type="text" name="guardian_relation" class="form-control" value="{{ $student->guardian_relation }}" placeholder="Father, Mother, etc.">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
