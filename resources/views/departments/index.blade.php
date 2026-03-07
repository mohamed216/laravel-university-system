@extends('layouts.app')

@section('title', __('Departments'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Departments') }}</h2>
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Department') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="faculty_id" class="form-select">
                    <option value="">{{ __('Faculty') }}</option>
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ request('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Faculty') }}</th>
                    <th>{{ __('Head') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $department)
                <tr>
                    <td>{{ $department->code }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->faculty->name ?? '-' }}</td>
                    <td>{{ $department->head_name }}</td>
                    <td>{{ $department->email }}</td>
                    <td>{{ $department->phone }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $departments->links() }}
    </div>
</div>
@endsection
