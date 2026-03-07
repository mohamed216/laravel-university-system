@extends('layouts.app')

@section('title', __('Grades Report'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Grades Report</h2>
        
        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-select">
                            <option value="">All Courses</option>
                            @foreach(\App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Grade</label>
                        <select name="grade" class="form-select">
                            <option value="">All Grades</option>
                            <option value="A+" {{ request('grade') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A" {{ request('grade') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="A-" {{ request('grade') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ request('grade') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B" {{ request('grade') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="B-" {{ request('grade') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="C+" {{ request('grade') == 'C+' ? 'selected' : '' }}>C+</option>
                            <option value="C" {{ request('grade') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="C-" {{ request('grade') == 'C-' ? 'selected' : '' }}>C-</option>
                            <option value="D" {{ request('grade') == 'D' ? 'selected' : '' }}>D</option>
                            <option value="F" {{ request('grade') == 'F' ? 'selected' : '' }}>F</option>
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
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('reports.grades') }}" class="btn btn-secondary">Reset</a>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}">PDF</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['export' => 'excel']) }}">Excel (CSV)</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Grade</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grades as $grade)
                            <tr>
                                <td>{{ $grade->id }}</td>
                                <td>{{ $grade->student?->name }}</td>
                                <td>{{ $grade->course?->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $grade->grade >= 'A' ? 'success' : ($grade->grade >= 'B' ? 'info' : ($grade->grade >= 'C' ? 'warning' : 'danger')) }}">
                                        {{ $grade->grade }}
                                    </span>
                                </td>
                                <td>{{ $grade->score }}</td>
                                <td>{{ $grade->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No grades found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
