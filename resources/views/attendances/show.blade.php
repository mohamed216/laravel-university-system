@extends('layouts.app')

@section('title', __('Attendance') . ' ' . __('Details'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Attendance') }} {{ __('Details') }}</h2>
    <div>
        <a href="{{ route('attendances.edit', $attendance) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Student Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Student ID') }}:</th>
                        <td>{{ $attendance->student->student_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $attendance->student->first_name ?? '' }} {{ $attendance->student->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $attendance->student->department->name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Course Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Course') }}:</th>
                        <td>{{ $attendance->courseSection->course->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Section') }}:</th>
                        <td>{{ $attendance->courseSection->section_number ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Attendance Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Date') }}:</th>
                        <td>{{ $attendance->date }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            @switch($attendance->status)
                                @case('present')
                                    <span class="badge bg-success">{{ __('Present') }}</span>
                                    @break
                                @case('absent')
                                    <span class="badge bg-danger">{{ __('Absent') }}</span>
                                    @break
                                @case('late')
                                    <span class="badge bg-warning">{{ __('Late') }}</span>
                                    @break
                                @case('excused')
                                    <span class="badge bg-info">{{ __('Excused') }}</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $attendance->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($attendance->notes)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Notes') }}</h5>
    </div>
    <div class="card-body">
        {{ $attendance->notes }}
    </div>
</div>
@endif
@endsection
