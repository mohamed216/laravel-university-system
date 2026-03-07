@extends('layouts.app')

@section('title', __('Professors'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Professors') }}</h2>
    <a href="{{ route('professors.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Professor') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="department_id" class="form-select">
                    <option value="">{{ __('Department') }}</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">{{ __('Status') }}</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                    <option value="on_leave" {{ request('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                    <option value="retired" {{ request('status') == 'retired' ? 'selected' : '' }}>{{ __('Retired') }}</option>
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
                    <th>{{ __('Employee ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Department') }}</th>
                    <th>{{ __('Specialization') }}</th>
                    <th>{{ __('Degree') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professors as $professor)
                <tr>
                    <td>{{ $professor->employee_id }}</td>
                    <td>{{ $professor->first_name }} {{ $professor->last_name }}</td>
                    <td>{{ $professor->department->name ?? '-' }}</td>
                    <td>{{ $professor->specialization }}</td>
                    <td>{{ $professor->degree }}</td>
                    <td>
                        <span class="badge bg-{{ $professor->status == 'active' ? 'success' : 'secondary' }}">
                            {{ __($professor->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('professors.show', $professor) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('professors.edit', $professor) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('professors.destroy', $professor) }}" method="POST" class="d-inline">
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
        {{ $professors->links() }}
    </div>
</div>
@endsection
