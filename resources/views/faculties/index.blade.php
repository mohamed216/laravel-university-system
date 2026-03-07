@extends('layouts.app')

@section('title', __('Faculties'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Faculties') }}</h2>
    <a href="{{ route('faculties.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('Add') }} {{ __('Faculty') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Name') }} (EN)</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Dean') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ $faculty->name_en }}</td>
                    <td>{{ $faculty->code }}</td>
                    <td>{{ $faculty->dean_name }}</td>
                    <td>{{ $faculty->phone }}</td>
                    <td>
                        <a href="{{ route('faculties.show', $faculty) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('faculties.edit', $faculty) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('faculties.destroy', $faculty) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
