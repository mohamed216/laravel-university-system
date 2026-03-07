@extends('layouts.app')

@section('title', __('Dashboard'))

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="row g-4">
    <!-- Total Students -->
    <div class="col-md-3">
        <div class="card stat-card blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Total Students') }}</h6>
                        <h3 class="mb-0">{{ $stats['total_students'] }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Professors -->
    <div class="col-md-3">
        <div class="card stat-card green">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Professors') }}</h6>
                        <h3 class="mb-0">{{ $stats['total_professors'] }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-person-badge text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Courses -->
    <div class="col-md-3">
        <div class="card stat-card orange">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Courses') }}</h6>
                        <h3 class="mb-0">{{ $stats['total_courses'] }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-book text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Payments -->
    <div class="col-md-3">
        <div class="card stat-card red">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Total Payments') }}</h6>
                        <h3 class="mb-0">${{ number_format($stats['total_payments'], 0) }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="bi bi-currency-dollar text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Quick Stats Row -->
    <div class="col-md-3">
        <div class="card stat-card blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Active Students') }}</h6>
                        <h3 class="mb-0">{{ $stats['active_students'] }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="bi bi-person-check text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card green">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Pending Enrollments') }}</h6>
                        <h3 class="mb-0">{{ $stats['pending_enrollments'] }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card orange">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Departments') }}</h6>
                        <h3 class="mb-0">{{ $stats['total_departments'] }}</h3>
                    </div>
                    <div class="bg-secondary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-diagram-3 text-secondary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card red">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Pending Payments') }}</h6>
                        <h3 class="mb-0">${{ number_format($stats['pending_payments'], 0) }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mt-2">
    <!-- Student Enrollment Trends -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Student Enrollment Trends') }}</h5>
            </div>
            <div class="card-body">
                <canvas id="enrollmentChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Fee Collection Trends -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Fee Collection Trends') }}</h5>
            </div>
            <div class="card-body">
                <canvas id="feeChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Department Distribution -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Students by Department') }}</h5>
            </div>
            <div class="card-body">
                <canvas id="departmentChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Recent Activities') }}</h5>
                <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <tbody>
                        @forelse($recentActivities ?? [] as $activity)
                        <tr>
                            <td>
                                <small>{{ $activity->user?->name ?? 'System' }}</small><br>
                                <span class="text-muted">{{ $activity->description ?? $activity->action }}</span>
                            </td>
                            <td class="text-end">
                                <small>{{ $activity->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">No recent activities</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Recent Students') }}</h5>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <tbody>
                        @foreach($recentStudents as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td><span class="badge bg-{{ $student->status === 'active' ? 'success' : ($student->status === 'new' ? 'primary' : 'info') }}">{{ $student->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Enrollment Trends Chart
    const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
    const enrollmentChart = new Chart(enrollmentCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($enrollmentTrends->pluck('month')) !!},
            datasets: [{
                label: 'New Students',
                data: {!! json_encode($enrollmentTrends->pluck('count')) !!},
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Fee Collection Chart
    const feeCtx = document.getElementById('feeChart').getContext('2d');
    const feeChart = new Chart(feeCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($feeTrends->pluck('month')) !!},
            datasets: [{
                label: 'Collection',
                data: {!! json_encode($feeTrends->pluck('total')) !!},
                backgroundColor: '#27ae60',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Department Distribution Chart
    const deptCtx = document.getElementById('departmentChart').getContext('2d');
    const departmentChart = new Chart(deptCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($departmentDistribution->keys()) !!},
            datasets: [{
                data: {!! json_encode($departmentDistribution->values()) !!},
                backgroundColor: [
                    '#3498db', '#27ae60', '#f39c12', '#e74c3c', '#9b59b6',
                    '#1abc9c', '#34495e', '#e67e22', '#2ecc71', '#3498db'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });
</script>
@endsection
