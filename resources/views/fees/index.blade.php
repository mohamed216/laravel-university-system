@extends('layouts.app')

@section('title', __('Fees'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Fees') }}</h2>
    <a href="{{ route('fees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Fee') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">{{ __('Type') }}</option>
                    <option value="tuition" {{ request('type') == 'tuition' ? 'selected' : '' }}>Tuition</option>
                    <option value="registration" {{ request('type') == 'registration' ? 'selected' : '' }}>Registration</option>
                    <option value="library" {{ request('type') == 'library' ? 'selected' : '' }}>Library</option>
                    <option value="laboratory" {{ request('type') == 'laboratory' ? 'selected' : '' }}>Laboratory</option>
                    <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="academic_year_id" class="form-select">
                    <option value="">{{ __('Academic Year') }}</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year->id }}" {{ request('academic_year_id') == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
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
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Academic Year') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Per Credit') }}</th>
                    <th>{{ __('Mandatory') }}</th>
                    <th>{{ __('Due Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr>
                    <td>{{ $fee->name }}</td>
                    <td>{{ ucfirst($fee->type) }}</td>
                    <td>{{ $fee->academicYear->name ?? '-' }}</td>
                    <td>{{ number_format($fee->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $fee->is_per_credit ? 'info' : 'secondary' }}">
                            {{ $fee->is_per_credit ? __('Yes') : __('No') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $fee->is_mandatory ? 'danger' : 'success' }}">
                            {{ $fee->is_mandatory ? __('Mandatory') : __('Optional') }}
                        </span>
                    </td>
                    <td>{{ $fee->due_date }}</td>
                    <td>
                        <a href="{{ route('fees.edit', $fee) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('fees.destroy', $fee) }}" method="POST" class="d-inline">
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
                    <td colspan="8" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $fees->links() }}
    </div>
</div>
@endsection
