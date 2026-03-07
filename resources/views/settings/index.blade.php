@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">System Settings</h2>
        
        <form method="POST" action="{{ route('settings.update') }}">
            @csrf
            
            <!-- General Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-gear me-2"></i>General Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">University Name</label>
                            <input type="text" name="settings[university_name]" class="form-control" 
                                value="{{ old('university_name', \App\Models\Setting::get('university_name', 'University System')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Current Academic Year</label>
                            <input type="number" name="settings[academic_year]" class="form-control" 
                                value="{{ old('academic_year', \App\Models\Setting::get('academic_year', date('Y'))) }}">
                        </div>
                    </div>
                    
                    <!-- Logo Upload -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">University Logo</label>
                            @if(\App\Models\Setting::get('university_logo'))
                            <div class="mb-2">
                                <img src="{{ asset(\App\Models\Setting::get('university_logo')) }}" alt="Logo" style="max-height: 80px;">
                            </div>
                            @endif
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="settings[contact_email]" class="form-control" 
                                value="{{ old('contact_email', \App\Models\Setting::get('contact_email', 'info@university.edu')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="settings[contact_phone]" class="form-control" 
                                value="{{ old('contact_phone', \App\Models\Setting::get('contact_phone', '+1 234 567 8900')) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="settings[contact_address]" class="form-control" 
                                value="{{ old('contact_address', \App\Models\Setting::get('contact_address', '123 University Ave')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="settings[contact_city]" class="form-control" 
                                value="{{ old('contact_city', \App\Models\Setting::get('contact_city', 'University City')) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-book me-2"></i>Academic Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Semester Start</label>
                            <input type="date" name="settings[semester_start]" class="form-control" 
                                value="{{ old('semester_start', \App\Models\Setting::get('semester_start', date('Y-01-01'))) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Semester End</label>
                            <input type="date" name="settings[semester_end]" class="form-control" 
                                value="{{ old('semester_end', \App\Models\Setting::get('semester_end', date('Y-06-30'))) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Registration Open</label>
                            <select name="settings[registration_open]" class="form-select">
                                <option value="true" {{ \App\Models\Setting::get('registration_open') ? 'selected' : '' }}>Yes</option>
                                <option value="false" {{ !\App\Models\Setting::get('registration_open') ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finance Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-currency-dollar me-2"></i>Finance Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Currency Symbol</label>
                            <input type="text" name="settings[currency_symbol]" class="form-control" 
                                value="{{ old('currency_symbol', \App\Models\Setting::get('currency_symbol', '$')) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Late Fee Percentage (%)</label>
                            <input type="number" name="settings[late_fee_percentage]" class="form-control" 
                                value="{{ old('late_fee_percentage', \App\Models\Setting::get('late_fee_percentage', 5)) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Settings</button>
                <a href="{{ route('settings.reset') }}" class="btn btn-warning" 
                    onclick="return confirm('Are you sure you want to reset all settings to defaults?')">Reset to Defaults</a>
            </div>
        </form>
    </div>
</div>
@endsection
