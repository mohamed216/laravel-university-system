@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $book->title }}</h2>
    <div>
        <a href="{{ route('library.edit', $book) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('library.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Book Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('ISBN') }}:</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Title') }}:</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Author') }}:</th>
                        <td>{{ $book->author }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Publisher') }}:</th>
                        <td>{{ $book->publisher }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Category') }}:</th>
                        <td>{{ ucfirst($book->category) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Edition') }}:</th>
                        <td>{{ $book->edition }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Year') }}:</th>
                        <td>{{ $book->publication_year }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Availability') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Total Copies') }}:</th>
                        <td>{{ $book->total_copies }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Available') }}:</th>
                        <td>
                            <span class="badge bg-{{ $book->available_copies > 0 ? 'success' : 'danger' }}">
                                {{ $book->available_copies }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Borrowed') }}:</th>
                        <td>{{ $book->total_copies - $book->available_copies }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($book->description)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Description') }}</h5>
    </div>
    <div class="card-body">
        {{ $book->description }}
    </div>
</div>
@endif
@endsection
