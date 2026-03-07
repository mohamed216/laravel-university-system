@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="row g-4">
    <!-- Total Students -->
    <div class="col-md-3">
        <div class="card stat-card blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Students') }}</h6>
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

    <!-- Total Faculties -->
    <div class="col-md-3">
        <div class="card stat-card red">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">{{ __('Faculties') }}</h6>
                        <h3 class="mb-0">{{ $stats['total_faculties'] }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="bi bi-building text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Student Status -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Students') }} {{ __('Status') }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>{{ __('Active') }}</span>
                    <span class="badge bg-success">{{ $stats['active_students'] }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>{{ __('New') }}</span>
                    <span class="badge bg-primary">{{ $stats['new_students'] }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>{{ __('Graduated') }}</span>
                    <span class="badge bg-info">{{ $stats['graduated_students'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Recent Students') }}</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <tbody>
                        @foreach($recentStudents as $student)
                        <tr>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->student_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Recent Payments') }}</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <tbody>
                        @foreach($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->student->first_name ?? 'N/A' }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
