@extends('layouts.app')

@section('title', $course->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $course->name }}</h2>
    <div>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Course Details') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Code') }}:</th>
                        <td>{{ $course->code }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }} (Arabic):</th>
                        <td>{{ $course->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }} (English):</th>
                        <td>{{ $course->name_en }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $course->department->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Credits') }}:</th>
                        <td>{{ $course->credits }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Level') }}:</th>
                        <td>Level {{ $course->level }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Total Hours') }}:</th>
                        <td>{{ $course->total_hours }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }}">
                                {{ $course->is_active ? __('Active') : __('Inactive') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Hours Breakdown') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>{{ __('Lecture') }}:</th>
                        <td>{{ $course->hours_lecture }} hrs</td>
                    </tr>
                    <tr>
                        <th>{{ __('Lab') }}:</th>
                        <td>{{ $course->hours_lab }} hrs</td>
                    </tr>
                    <tr>
                        <th>{{ __('Tutorial') }}:</th>
                        <td>{{ $course->hours_tutorial }} hrs</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($course->description)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Description') }}</h5>
    </div>
    <div class="card-body">
        {{ $course->description }}
    </div>
</div>
@endif
@endsection
