@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Department'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Department') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Faculty') }}</label>
                    <select name="faculty_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Faculty') }}</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $department->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $department->code }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (Arabic)</label>
                    <input type="text" name="name" class="form-control" value="{{ $department->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (English)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $department->name_en }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department Head') }}</label>
                    <input type="text" name="head_name" class="form-control" value="{{ $department->head_name }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ $department->email }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $department->phone }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3">{{ $department->description }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
