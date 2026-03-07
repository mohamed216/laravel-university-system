<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'University System'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Tahoma', 'Arial', sans-serif" : "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" }};
        }
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 4px;
            margin: 2px 0;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stat-card {
            border-left: 4px solid;
        }
        .stat-card.blue { border-color: #3498db; }
        .stat-card.green { border-color: #27ae60; }
        .stat-card.orange { border-color: #f39c12; }
        .stat-card.red { border-color: #e74c3c; }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 text-center border-bottom">
                    <h5>{{ __('University System') }}</h5>
                </div>
                <div class="p-2">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('faculties.index') }}" class="{{ request()->routeIs('faculties.*') ? 'active' : '' }}">
                        <i class="bi bi-building me-2"></i> {{ __('Faculties') }}
                    </a>
                    <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                        <i class="bi bi-diagram-3 me-2"></i> {{ __('Departments') }}
                    </a>
                    <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> {{ __('Students') }}
                    </a>
                    <a href="{{ route('professors.index') }}" class="{{ request()->routeIs('professors.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge me-2"></i> {{ __('Professors') }}
                    </a>
                    <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <i class="bi bi-book me-2"></i> {{ __('Courses') }}
                    </a>
                    <a href="{{ route('enrollments.index') }}" class="{{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check me-2"></i> {{ __('Enrollment') }}
                    </a>
                    <a href="{{ route('fees.index') }}" class="{{ request()->routeIs('fees.*') ? 'active' : '' }}">
                        <i class="bi bi-currency-dollar me-2"></i> {{ __('Fees') }}
                    </a>
                    <a href="{{ route('library.index') }}" class="{{ request()->routeIs('library.*') ? 'active' : '' }}">
                        <i class="bi bi-library me-2"></i> {{ __('Library') }}
                    </a>
                    <a href="{{ route('online-lectures.index') }}" class="{{ request()->routeIs('online-lectures.*') ? 'active' : '' }}">
                        <i class="bi bi-camera-video me-2"></i> {{ __('Online Lectures') }}
                    </a>
                    
                    @role('admin')
                    <hr class="my-2">
                    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> {{ __('Reports') }}
                    </a>
                    <a href="{{ route('activities.index') }}" class="{{ request()->routeIs('activities.*') ? 'active' : '' }}">
                        <i class="bi bi-activity me-2"></i> {{ __('Activity Log') }}
                    </a>
                    <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> {{ __('Settings') }}
                    </a>
                    @endrole
                </div>
            </div>
            @endauth
            
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-12' }}">
                @auth
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">@yield('title', __('Dashboard'))</span>
                        <div class="d-flex align-items-center">
                            <!-- Language Switcher -->
                            <div class="dropdown me-3">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-globe"></i> {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}">English</a></li>
                                    <li><a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                                </ul>
                            </div>
                            <span class="me-3">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
                @endauth
                
                <div class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
