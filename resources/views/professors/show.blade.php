@extends('layouts.app')

@section('title', $professor->full_name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $professor->full_name }}</h2>
    <div>
        <a href="{{ route('professors.edit', $professor) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('professors.index') }}" class="btn btn-secondary">
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
                        <th width="200">{{ __('Employee ID') }}:</th>
                        <td>{{ $professor->employee_id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $professor->first_name }} {{ $professor->last_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }} (EN):</th>
                        <td>{{ $professor->full_name_en }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $professor->department->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Birth Date') }}:</th>
                        <td>{{ $professor->birth_date }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Phone') }}:</th>
                        <td>{{ $professor->phone }}</td>
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
                        <th width="200">{{ __('Specialization') }}:</th>
                        <td>{{ $professor->specialization }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Degree') }}:</th>
                        <td>{{ $professor->degree }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Office') }}:</th>
                        <td>{{ $professor->office }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Office Hours') }}:</th>
                        <td>{{ $professor->office_hours }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            <span class="badge bg-{{ $professor->status == 'active' ? 'success' : 'secondary' }}">
                                {{ __($professor->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($professor->qualifications)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Qualifications') }}</h5>
    </div>
    <div class="card-body">
        {{ $professor->qualifications }}
    </div>
</div>
@endif
@endsection
