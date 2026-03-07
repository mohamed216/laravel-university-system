@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Faculty'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Faculty') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('faculties.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (Arabic)</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Name') }} (English)</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Dean') }}</label>
                    <input type="text" name="dean_name" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Building') }}</label>
                    <input type="text" name="building" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('faculties.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
