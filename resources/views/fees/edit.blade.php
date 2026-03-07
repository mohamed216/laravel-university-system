@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Fee'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Fee') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('fees.update', $fee) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ $fee->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Academic Year') }}</label>
                    <select name="academic_year_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Academic Year') }}</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ $fee->academic_year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Type') }}</label>
                    <select name="type" class="form-select" required>
                        <option value="tuition" {{ $fee->type == 'tuition' ? 'selected' : '' }}>Tuition</option>
                        <option value="registration" {{ $fee->type == 'registration' ? 'selected' : '' }}>Registration</option>
                        <option value="library" {{ $fee->type == 'library' ? 'selected' : '' }}>Library</option>
                        <option value="laboratory" {{ $fee->type == 'laboratory' ? 'selected' : '' }}>Laboratory</option>
                        <option value="other" {{ $fee->type == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Amount') }}</label>
                    <input type="number" name="amount" class="form-control" step="0.01" value="{{ $fee->amount }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Due Date') }}</label>
                    <input type="date" name="due_date" class="form-control" value="{{ $fee->due_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="2">{{ $fee->description }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_per_credit" class="form-check-input" id="is_per_credit" value="1" {{ $fee->is_per_credit ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_per_credit">{{ __('Per Credit') }}</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_mandatory" class="form-check-input" id="is_mandatory" value="1" {{ $fee->is_mandatory ? 'checked' : '' }}>
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
