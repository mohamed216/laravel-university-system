@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Course'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Course') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $course->code }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Department') }}</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">{{ __('Select') }} {{ __('Department') }}</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $course->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (Arabic)</label>
                    <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (English)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $course->name_en }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Credits') }}</label>
                    <input type="number" name="credits" class="form-control" value="{{ $course->credits }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Level') }}</label>
                    <select name="level" class="form-select" required>
                        <option value="1" {{ $course->level == 1 ? 'selected' : '' }}>Level 1</option>
                        <option value="2" {{ $course->level == 2 ? 'selected' : '' }}>Level 2</option>
                        <option value="3" {{ $course->level == 3 ? 'selected' : '' }}>Level 3</option>
                        <option value="4" {{ $course->level == 4 ? 'selected' : '' }}>Level 4</option>
                        <option value="5" {{ $course->level == 5 ? 'selected' : '' }}>Level 5</option>
                        <option value="6" {{ $course->level == 6 ? 'selected' : '' }}>Level 6</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Lecture Hours') }}</label>
                    <input type="number" name="hours_lecture" class="form-control" value="{{ $course->hours_lecture }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Lab Hours') }}</label>
                    <input type="number" name="hours_lab" class="form-control" value="{{ $course->hours_lab }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Tutorial Hours') }}</label>
                    <input type="number" name="hours_tutorial" class="form-control" value="{{ $course->hours_tutorial }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3">{{ $course->description }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $course->is_active ? 'checked' : '' }}>
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
