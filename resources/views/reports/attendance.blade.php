@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-clipboard-check"></i> Attendance Reports</h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>

    <div class="row">
        <div class="col-md-2 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3>{{ $totalAttendance }}</h3>
                    <p>Total Records</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>{{ $presentCount }}</h3>
                    <p>Present</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h3>{{ $absentCount }}</h3>
                    <p>Absent</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h3>{{ $lateCount }}</h3>
                    <p>Late</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h3>{{ $excusedCount }}</h3>
                    <p>Excused</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h3>{{ $attendanceRate }}%</h3>
                    <p>Attendance Rate</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Attendance by Course</h5>
                </div>
                <div class="card-body">
                    @if($attendanceByCourse->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Total</th>
                                    <th>Present</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendanceByCourse as $course)
                                <tr>
                                    <td>{{ $course['course'] }}</td>
                                    <td>{{ $course['total'] }}</td>
                                    <td>{{ $course['present'] }}</td>
                                    <td><span class="badge bg-{{ $course['rate'] >= 80 ? 'success' : ($course['rate'] >= 60 ? 'warning' : 'danger') }}">{{ $course['rate'] }}%</span></td>
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
                    <h5>Recent Attendance</h5>
                </div>
                <div class="card-body">
                    @if($recentAttendance->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAttendance as $attendance)
                                <tr>
                                    <td>{{ $attendance->student->first_name ?? 'N/A' }} {{ $attendance->student->last_name ?? '' }}</td>
                                    <td>{{ $attendance->courseSection->course->name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>
                                        @switch($attendance->status)
                                            @case('present')
                                                <span class="badge bg-success">Present</span>
                                                @break
                                            @case('absent')
                                                <span class="badge bg-danger">Absent</span>
                                                @break
                                            @case('late')
                                                <span class="badge bg-warning">Late</span>
                                                @break
                                            @case('excused')
                                                <span class="badge bg-info">Excused</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No recent attendance</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
