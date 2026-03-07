@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-users"></i> Student Statistics</h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $totalStudents }}</h3>
                    <p>Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $activeStudents }}</h3>
                    <p>Active Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h3>{{ $studentsByDepartment->count() }}</h3>
                    <p>Departments</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Students by Department</h5>
                </div>
                <div class="card-body">
                    @if($studentsByDepartment->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentsByDepartment as $dept)
                                <tr>
                                    <td>{{ $dept['department'] }}</td>
                                    <td><span class="badge bg-primary">{{ $dept['count'] }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No data available</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Students by Status</h5>
                </div>
                <div class="card-body">
                    @if($studentsByStatus->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentsByStatus as $status)
                                <tr>
                                    <td><span class="badge bg-{{ $status['status'] == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($status['status']) }}</span></td>
                                    <td><span class="badge bg-primary">{{ $status['count'] }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No data available</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Students by Level</h5>
                </div>
                <div class="card-body">
                    @if($studentsByLevel->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentsByLevel as $level)
                                <tr>
                                    <td>Year {{ $level['level'] }}</td>
                                    <td><span class="badge bg-info">{{ $level['count'] }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
