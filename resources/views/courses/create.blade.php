@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Course'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Course') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" required>
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
                    <label class="form-label">{{ __('Name') }} (Arabic)</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (English)</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Credits') }}</label>
                    <input type="number" name="credits" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Level') }}</label>
                    <select name="level" class="form-select" required>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                        <option value="6">Level 6</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Lecture Hours') }}</label>
                    <input type="number" name="hours_lecture" class="form-control" value="0">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Lab Hours') }}</label>
                    <input type="number" name="hours_lab" class="form-control" value="0">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Tutorial Hours') }}</label>
                    <input type="number" name="hours_tutorial" class="form-control" value="0">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
