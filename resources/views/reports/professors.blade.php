@extends('layouts.app')

@section('content')
<div class="container">
    <div justify-content-between align class="d-flex-items-center mb-4">
        <h1><i class="fas fa-chalkboard-teacher"></i> Professor Statistics</h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $totalProfessors }}</h3>
                    <p>Total Professors</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $activeProfessors }}</h3>
                    <p>Active Professors</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h3>{{ $professorsByDepartment->count() }}</h3>
                    <p>Departments</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Professors by Department</h5>
                </div>
                <div class="card-body">
                    @if($professorsByDepartment->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professorsByDepartment as $dept)
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
                    <h5>Professors by Status</h5>
                </div>
                <div class="card-body">
                    @if($professorsByStatus->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professorsByStatus as $status)
                                <tr>
                                    <td><span class="badge bg-{{ $status['status'] == 'active' ? 'success' : 'warning' }}">{{ ucfirst($status['status']) }}</span></td>
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
                    <h5>Professors by Degree</h5>
                </div>
                <div class="card-body">
                    @if($professorsByDegree->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Degree</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professorsByDegree as $degree)
                                <tr>
                                    <td>{{ $degree['degree'] }}</td>
                                    <td><span class="badge bg-info">{{ $degree['count'] }}</span></td>
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
