@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Alert</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('alerts.update', $alert->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $alert->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required>{{ $alert->message }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label>
                            <select class="form-select">Type</label" id="type" name="type" required>
                                @foreach($alertTypes as $type)
                                <option value="{{ $type }}" {{ $alert->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="display_position" class="form-label">Display Position</label>
                            <select class="form-select" id="display_position" name="display_position">
                                @foreach($displayPositions as $position)
                                <option value="{{ $position }}" {{ $alert->display_position == $position ? 'selected' : '' }}>{{ ucfirst($position) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date (Optional)</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" 
                                       value="{{ $alert->start_date ? $alert->start_date->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date (Optional)</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" 
                                       value="{{ $alert->end_date ? $alert->end_date->format('Y-m-d\TH:i') : '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="display_order" class="form-label">Display Order</label>
                                <input type="number" class="form-control" id="display_order" name="display_order" 
                                       value="{{ $alert->display_order }}" min="0">
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $alert->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_dismissible" name="is_dismissible" {{ $alert->is_dismissible ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_dismissible">Dismissible by Users</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Alert</button>
                            <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
