@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-exclamation-triangle"></i> System Alerts</h1>
        <a href="{{ route('alerts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Alert
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('alerts.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') === 'active' ? 'active' : '' }}" href="{{ route('alerts.index', ['status' => 'active']) }}">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') === 'inactive' ? 'active' : '' }}" href="{{ route('alerts.index', ['status' => 'inactive']) }}">Inactive</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @if($alerts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alerts as $alert)
                                    <tr>
                                        <td>{{ $alert->id }}</td>
                                        <td>{{ $alert->title }}</td>
                                        <td>
                                            @switch($alert->type)
                                                @case('info')
                                                    <span class="badge bg-info">Info</span>
                                                    @break
                                                @case('warning')
                                                    <span class="badge bg-warning">Warning</span>
                                                    @break
                                                @case('danger')
                                                    <span class="badge bg-danger">Danger</span>
                                                    @break
                                                @case('success')
                                                    <span class="badge bg-success">Success</span>
                                                    @break
                                                @case('maintenance')
                                                    <span class="badge bg-secondary">Maintenance</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ ucfirst($alert->display_position) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $alert->is_active ? 'success' : 'secondary' }}">
                                                {{ $alert->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $alert->start_date ? $alert->start_date->format('M d, Y') : 'N/A' }}</td>
                                        <td>{{ $alert->end_date ? $alert->end_date->format('M d, Y') : 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-{{ $alert->is_active ? 'warning' : 'success' }}" 
                                                    onclick="toggleAlert({{ $alert->id }})">
                                                {{ $alert->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                            <a href="{{ route('alerts.edit', $alert->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('alerts.destroy', $alert->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $alerts->links() }}
                    @else
                        <p class="text-muted">No alerts found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleAlert(id) {
    fetch(`/alerts/${id}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    });
}
</script>
@endpush
@endsection
