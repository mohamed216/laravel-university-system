@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Book'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Book') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('library.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('ISBN') }} *</label>
                    <input type="text" name="isbn" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Author') }} *</label>
                    <input type="text" name="author" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Publisher') }}</label>
                    <input type="text" name="publisher" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Category') }}</label>
                    <select name="category" class="form-select">
                        <option value="reference">Reference</option>
                        <option value="textbook">Textbook</option>
                        <option value="fiction">Fiction</option>
                        <option value="journal">Journal</option>
                        <option value="magazine">Magazine</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Edition') }}</label>
                    <input type="text" name="edition" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Year') }}</label>
                    <input type="number" name="publication_year" class="form-control" min="1900" max="2100">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Total Copies') }}</label>
                    <input type="number" name="total_copies" class="form-control" value="1" min="1">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('library.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
