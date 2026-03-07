@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Student'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Student') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (Arabic) *</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (English)</label>
                    <input type="text" name="first_name_en" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (Arabic) *</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (English)</label>
                    <input type="text" name="last_name_en" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student ID') }} *</label>
                    <input type="text" name="student_id" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department') }} *</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email') }} *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Password') }} *</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Gender') }}</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="male">{{ __('Male') }}</option>
                        <option value="female">{{ __('Female') }}</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Birth Date') }}</label>
                    <input type="date" name="birth_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('National ID') }}</label>
                    <input type="text" name="national_id" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Nationality') }}</label>
                    <input type="text" name="nationality" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Address') }}</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>
                <hr>
                <h6 class="mb-3">{{ __('Guardian') }} {{ __('Information') }}</h6>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Name') }}</label>
                    <input type="text" name="guardian_name" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Phone') }}</label>
                    <input type="text" name="guardian_phone" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Guardian Relation') }}</label>
                    <input type="text" name="guardian_relation" class="form-control" placeholder="Father, Mother, etc.">
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
