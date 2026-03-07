@extends('layouts.app')

@section('title', $department->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $department->name }}</h2>
    <div>
        <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Department Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Code') }}:</th>
                        <td>{{ $department->code }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $department->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Faculty') }}:</th>
                        <td>{{ $department->faculty->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Head') }}:</th>
                        <td>{{ $department->head_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Email') }}:</th>
                        <td>{{ $department->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Phone') }}:</th>
                        <td>{{ $department->phone }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Statistics') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Courses') }}:</th>
                        <td>{{ $department->courses->count() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Professors') }}:</th>
                        <td>{{ $department->professors->count() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Students') }}:</th>
                        <td>{{ $department->students->count() ?? 0 }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($department->description)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Description') }}</h5>
    </div>
    <div class="card-body">
        {{ $department->description }}
    </div>
</div>
@endif
@endsection
