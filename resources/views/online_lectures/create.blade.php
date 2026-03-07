@extends('layouts.app')

@section('title', __('Add Online Lecture'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add Online Lecture') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('online-lectures.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Course Section') }} *</label>
                    <select name="course_section_id" class="form-select" required>
                        <option value="">-- {{ __('Select') }} --</option>
                        @foreach($courseSections as $section)
                            <option value="{{ $section->id }}">{{ $section->course->name ?? 'N/A' }} - {{ $section->section_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Professor') }} *</label>
                    <select name="professor_id" class="form-select" required>
                        <option value="">-- {{ __('Select') }} --</option>
                        @foreach($professors as $professor)
                            <option value="{{ $professor->id }}">{{ $professor->first_name }} {{ $professor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Date & Time') }} *</label>
                    <input type="datetime-local" name="scheduled_at" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Duration (minutes)') }} *</label>
                    <input type="number" name="duration_minutes" class="form-control" value="60" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Meeting Link') }}</label>
                    <input type="url" name="meeting_link" class="form-control" placeholder="https://zoom.us/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Meeting ID') }}</label>
                    <input type="text" name="meeting_id" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Meeting Password') }}</label>
                    <input type="text" name="meeting_password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Video URL') }}</label>
                    <input type="url" name="video_url" class="form-control" placeholder="YouTube, Vimeo...">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_recording_enabled" class="form-check-input" id="recording" checked>
                        <label class="form-check-label" for="recording">{{ __('Enable Recording') }}</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('online-lectures.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
