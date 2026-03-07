@extends('layouts.app')

@section('title', __('Online Lectures'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Online Lectures') }}</h2>
    @can('role:admin,professor')
    <a href="{{ route('online-lectures.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Online Lecture') }}
    </a>
    @endcan
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">{{ __('Status') }}</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>{{ __('Scheduled') }}</option>
                    <option value="live" {{ request('status') == 'live' ? 'selected' : '' }}>{{ __('Live') }}</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Course') }}</th>
                    <th>{{ __('Professor') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Duration') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lectures as $lecture)
                <tr>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->courseSection->course->name ?? '-' }}</td>
                    <td>{{ $lecture->professor->first_name ?? '' }} {{ $lecture->professor->last_name ?? '' }}</td>
                    <td>{{ $lecture->scheduled_at }}</td>
                    <td>{{ $lecture->duration_minutes }} {{ __('min') }}</td>
                    <td>
                        <span class="badge bg-{{ $lecture->status == 'live' ? 'danger' : ($lecture->status == 'completed' ? 'success' : 'warning') }}">
                            {{ __($lecture->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('online-lectures.show', $lecture) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        @can('role:admin,professor')
                        <a href="{{ route('online-lectures.edit', $lecture) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $lectures->links() }}
    </div>
</div>
@endsection
