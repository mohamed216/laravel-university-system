@extends('layouts.app')

@section('title', __('Grade') . ' ' . __('Details'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Grade') }} {{ __('Details') }}</h2>
    <div>
        <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">
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
                        <td>{{ $grade->enrollment->student->student_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $grade->enrollment->student->first_name ?? '' }} {{ $grade->enrollment->student->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $grade->enrollment->student->department->name ?? '-' }}</td>
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
                        <td>{{ $grade->enrollment->courseSection->course->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Section') }}:</th>
                        <td>{{ $grade->enrollment->courseSection->section_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Semester') }}:</th>
                        <td>{{ $grade->semester->name ?? '-' }}</td>
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
                <h5>{{ __('Grade Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Letter Grade') }}:</th>
                        <td>
                            <span class="badge bg-{{ $grade->letter_grade >= 'C' ? 'success' : 'danger' }}">
                                {{ $grade->letter_grade }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Percentage') }}:</th>
                        <td>{{ number_format($grade->percentage, 2) }}%</td>
                    </tr>
                    <tr>
                        <th>{{ __('Grade Points') }}:</th>
                        <td>{{ number_format($grade->grade_points, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Submission Date') }}:</th>
                        <td>{{ $grade->submission_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($grade->notes)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Notes') }}</h5>
    </div>
    <div class="card-body">
        {{ $grade->notes }}
    </div>
</div>
@endif
@endsection
