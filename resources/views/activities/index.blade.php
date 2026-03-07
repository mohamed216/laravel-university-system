@extends('layouts.app')

@section('title', __('Activity Log'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Activity Log</h2>
        
        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-select">
                            <option value="">All Users</option>
                            @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Action</label>
                        <select name="action" class="form-select">
                            <option value="">All Actions</option>
                            @foreach($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ ucfirst($action) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Activity List -->
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                        <tr>
                            <td>
                                <small>{{ $activity->created_at->format('Y-m-d H:i:s') }}</small><br>
                                <span class="text-muted">{{ $activity->created_at->diffForHumans() }}</span>
                            </td>
                            <td>{{ $activity->user?->name ?? 'System' }}</td>
                            <td>
                                <span class="badge bg-{{ $activity->action === 'login' ? 'success' : ($activity->action === 'create' ? 'primary' : ($activity->action === 'delete' ? 'danger' : 'warning')) }}">
                                    {{ ucfirst($activity->action) }}
                                </span>
                            </td>
                            <td>
                                @if($activity->description)
                                {{ $activity->description }}
                                @elseif($activity->entity_type)
                                {{ class_basename($activity->entity_type) }} #{{ $activity->entity_id }}
                                @else
                                -
                                @endif
                            </td>
                            <td><small class="text-muted">{{ $activity->ip_address ?? '-' }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No activities found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-3">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection
