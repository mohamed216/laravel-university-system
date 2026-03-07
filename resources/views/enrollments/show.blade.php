@extends('layouts.app')

@section('title', __('Enrollment') . ' ' . __('Details'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Enrollment') }} {{ __('Details') }}</h2>
    <div>
        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
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
                        <td>{{ $enrollment->student->student_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $enrollment->student->department->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Email') }}:</th>
                        <td>{{ $enrollment->student->email ?? '-' }}</td>
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
                        <td>{{ $enrollment->courseSection->course->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Section') }}:</th>
                        <td>{{ $enrollment->courseSection->section_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Semester') }}:</th>
                        <td>{{ $enrollment->semester->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Professor') }}:</th>
                        <td>{{ $enrollment->courseSection->professor->first_name ?? '' }} {{ $enrollment->courseSection->professor->last_name ?? '' }}</td>
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
                <h5>{{ __('Enrollment Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Enrollment Date') }}:</th>
                        <td>{{ $enrollment->enrollment_date }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            @switch($enrollment->status)
                                @case('pending')
                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @break
                                @case('approved')
                                    <span class="badge bg-info">{{ __('Approved') }}</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">{{ __('Completed') }}</span>
                                    @break
                                @case('dropped')
                                    <span class="badge bg-danger">{{ __('Dropped') }}</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $enrollment->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
