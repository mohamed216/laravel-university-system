@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Professor'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Professor') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('professors.update', $professor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Employee ID') }}</label>
                    <input type="text" name="employee_id" class="form-control" value="{{ $professor->employee_id }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department') }}</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Department') }}</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $professor->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (Arabic)</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $professor->first_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (English)</label>
                    <input type="text" name="first_name_en" class="form-control" value="{{ $professor->first_name_en }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (Arabic)</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $professor->last_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (English)</label>
                    <input type="text" name="last_name_en" class="form-control" value="{{ $professor->last_name_en }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Specialization') }}</label>
                    <input type="text" name="specialization" class="form-control" value="{{ $professor->specialization }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Degree') }}</label>
                    <select name="degree" class="form-select">
                        <option value="Teaching Assistant" {{ $professor->degree == 'Teaching Assistant' ? 'selected' : '' }}>Teaching Assistant</option>
                        <option value="Lecturer" {{ $professor->degree == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                        <option value="Assistant Professor" {{ $professor->degree == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                        <option value="Associate Professor" {{ $professor->degree == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                        <option value="Professor" {{ $professor->degree == 'Professor' ? 'selected' : '' }}>Professor</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $professor->phone }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Birth Date') }}</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ $professor->birth_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Office') }}</label>
                    <input type="text" name="office" class="form-control" value="{{ $professor->office }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Office Hours') }}</label>
                    <input type="text" name="office_hours" class="form-control" value="{{ $professor->office_hours }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Qualifications') }}</label>
                    <textarea name="qualifications" class="form-control" rows="3">{{ $professor->qualifications }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ $professor->status == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                        <option value="on_leave" {{ $professor->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                        <option value="retired" {{ $professor->status == 'retired' ? 'selected' : '' }}>{{ __('Retired') }}</option>
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('professors.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
