@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Fee'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Fee') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('fees.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Academic Year') }}</label>
                    <select name="academic_year_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Academic Year') }}</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Type') }}</label>
                    <select name="type" class="form-select" required>
                        <option value="tuition">Tuition</option>
                        <option value="registration">Registration</option>
                        <option value="library">Library</option>
                        <option value="laboratory">Laboratory</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Amount') }}</label>
                    <input type="number" name="amount" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Due Date') }}</label>
                    <input type="date" name="due_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_per_credit" class="form-check-input" id="is_per_credit" value="1">
                        <label class="form-check-label" for="is_per_credit">{{ __('Per Credit') }}</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_mandatory" class="form-check-input" id="is_mandatory" value="1" checked>
                        <label class="form-check-label" for="is_mandatory">{{ __('Mandatory') }}</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('fees.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
