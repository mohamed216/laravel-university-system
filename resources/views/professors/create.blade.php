@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Professor'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Professor') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('professors.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Employee ID') }}</label>
                    <input type="text" name="employee_id" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department') }}</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Department') }}</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (Arabic)</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('First Name') }} (English)</label>
                    <input type="text" name="first_name_en" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (Arabic)</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Last Name') }} (English)</label>
                    <input type="text" name="last_name_en" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Specialization') }}</label>
                    <input type="text" name="specialization" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Degree') }}</label>
                    <select name="degree" class="form-select">
                        <option value="Teaching Assistant">Teaching Assistant</option>
                        <option value="Lecturer">Lecturer</option>
                        <option value="Assistant Professor">Assistant Professor</option>
                        <option value="Associate Professor">Associate Professor</option>
                        <option value="Professor">Professor</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Birth Date') }}</label>
                    <input type="date" name="birth_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Office') }}</label>
                    <input type="text" name="office" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Office Hours') }}</label>
                    <input type="text" name="office_hours" class="form-control" placeholder="e.g., Sun-Thu 9:00-15:00">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Qualifications') }}</label>
                    <textarea name="qualifications" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-select">
                        <option value="active">{{ __('Active') }}</option>
                        <option value="on_leave">On Leave</option>
                        <option value="retired">{{ __('Retired') }}</option>
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
