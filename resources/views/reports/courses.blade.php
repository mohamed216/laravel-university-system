@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-book"></i> Course Statistics</h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h3>{{ $totalCourses }}</h3>
                    <p>Total Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $activeCourses }}</h3>
                    <p>Active Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h3>{{ $totalCredits }}</h3>
                    <p>Total Credits</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Courses by Department</h5>
                </div>
                <div class="card-body">
                    @if($coursesByDepartment->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coursesByDepartment as $dept)
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
                    <h5>Courses by Level</h5>
                </div>
                <div class="card-body">
                    @if($coursesByLevel->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coursesByLevel as $level)
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
