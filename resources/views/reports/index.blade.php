@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Reports & Statistics</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Student Statistics -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Student Statistics</h5>
                </div>
                <div class="card-body">
                    <p>View student demographics, enrollment status, and academic levels.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Students by Department
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Student::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Students by Status
                            <span class="badge bg-success rounded-pill">{{ \App\Models\Student::where('status', 'active')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Students by Level
                            <span class="badge bg-info rounded-pill">{{ \App\Models\Student::distinct()->count('current_level') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('reports.students') }}" class="btn btn-primary mt-3">View Details</a>
                </div>
            </div>
        </div>

        <!-- Professor Statistics -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chalkboard-teacher"></i> Professor Statistics</h5>
                </div>
                <div class="card-body">
                    <p>View professor distribution, departments, and qualifications.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Professors
                            <span class="badge bg-success rounded-pill">{{ \App\Models\Professor::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Active Professors
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Professor::where('status', 'active')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            By Department
                            <span class="badge bg-info rounded-pill">{{ \App\Models\Professor::distinct()->count('department_id') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('reports.professors') }}" class="btn btn-success mt-3">View Details</a>
                </div>
            </div>
        </div>

        <!-- Course Statistics -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Course Statistics</h5>
                </div>
                <div class="card-body">
                    <p>View course distribution, credits, and levels.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Courses
                            <span class="badge bg-info rounded-pill">{{ \App\Models\Course::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Active Courses
                            <span class="badge bg-success rounded-pill">{{ \App\Models\Course::where('is_active', true)->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Credits
                            <span class="badge bg-warning rounded-pill">{{ \App\Models\Course::sum('credits') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('reports.courses') }}" class="btn btn-info mt-3">View Details</a>
                </div>
            </div>
        </div>

        <!-- Financial Reports -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-dollar-sign"></i> Financial Reports</h5>
                </div>
                <div class="card-body">
                    <p>View fee collection, payments, and outstanding balances.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Expected
                            <span class="badge bg-warning rounded-pill">${{ number_format(\App\Models\StudentFee::sum('amount'), 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Paid
                            <span class="badge bg-success rounded-pill">${{ number_format(\App\Models\StudentFee::where('status', 'paid')->sum('paid_amount'), 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Pending
                            <span class="badge bg-danger rounded-pill">${{ number_format(\App\Models\StudentFee::whereIn('status', ['pending', 'partial'])->sum('amount'), 2) }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('reports.financial') }}" class="btn btn-warning mt-3">View Details</a>
                </div>
            </div>
        </div>

        <!-- Attendance Reports -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-clipboard-check"></i> Attendance Reports</h5>
                </div>
                <div class="card-body">
                    <p>View attendance statistics and trends.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Records
                            <span class="badge bg-danger rounded-pill">{{ \App\Models\Attendance::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Present
                            <span class="badge bg-success rounded-pill">{{ \App\Models\Attendance::where('status', 'present')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Absent
                            <span class="badge bg-secondary rounded-pill">{{ \App\Models\Attendance::where('status', 'absent')->count() }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('reports.attendance') }}" class="btn btn-danger mt-3">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
