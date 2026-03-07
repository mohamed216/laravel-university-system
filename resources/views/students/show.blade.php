@extends('layouts.app')

@section('title', $student->first_name . ' ' . $student->last_name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $student->first_name }} {{ $student->last_name }}</h2>
    <div>
        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Personal Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Student ID') }}:</th>
                        <td>{{ $student->student_id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }} (EN):</th>
                        <td>{{ $student->first_name_en }} {{ $student->last_name_en }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Email') }}:</th>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Phone') }}:</th>
                        <td>{{ $student->phone }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Gender') }}:</th>
                        <td>{{ ucfirst($student->gender) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Birth Date') }}:</th>
                        <td>{{ $student->birth_date }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('National ID') }}:</th>
                        <td>{{ $student->national_id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Nationality') }}:</th>
                        <td>{{ $student->nationality }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Address') }}:</th>
                        <td>{{ $student->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Academic Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Department') }}:</th>
                        <td>{{ $student->department->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Level') }}:</th>
                        <td>{{ $student->current_level }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('GPA') }}:</th>
                        <td>{{ number_format($student->gpa, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Credits') }}:</th>
                        <td>{{ $student->earned_credits }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'new' ? 'primary' : 'secondary') }}">
                                {{ __($student->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Enrollment Date') }}:</th>
                        <td>{{ $student->enrollment_date }}</td>
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
                <h5>{{ __('Guardian Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Guardian Name') }}:</th>
                        <td>{{ $student->guardian_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Guardian Phone') }}:</th>
                        <td>{{ $student->guardian_phone }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Guardian Relation') }}:</th>
                        <td>{{ $student->guardian_relation }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
