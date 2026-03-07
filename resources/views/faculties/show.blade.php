@extends('layouts.app')

@section('title', $faculty->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $faculty->name }}</h2>
    <div>
        <a href="{{ route('faculties.edit', $faculty) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('faculties.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Faculty Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Name') }}:</th>
                        <td>{{ $faculty->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }} (EN):</th>
                        <td>{{ $faculty->name_en }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Code') }}:</th>
                        <td>{{ $faculty->code }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Dean') }}:</th>
                        <td>{{ $faculty->dean_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Email') }}:</th>
                        <td>{{ $faculty->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Phone') }}:</th>
                        <td>{{ $faculty->phone }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Building') }}:</th>
                        <td>{{ $faculty->building }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Departments') }}</h5>
            </div>
            <div class="card-body">
                @if($faculty->departments->count() > 0)
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Head') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faculty->departments as $department)
                            <tr>
                                <td>{{ $department->code }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->head_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">{{ __('No departments found') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@if($faculty->description)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Description') }}</h5>
    </div>
    <div class="card-body">
        {{ $faculty->description }}
    </div>
</div>
@endif
@endsection
