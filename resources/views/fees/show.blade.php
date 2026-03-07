@extends('layouts.app')

@section('title', $fee->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $fee->name }}</h2>
    <div>
        <a href="{{ route('fees.edit', $fee) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('fees.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Fee Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Name') }}:</th>
                        <td>{{ $fee->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Type') }}:</th>
                        <td>{{ ucfirst($fee->type) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Academic Year') }}:</th>
                        <td>{{ $fee->academicYear->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Amount') }}:</th>
                        <td>{{ number_format($fee->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Due Date') }}:</th>
                        <td>{{ $fee->due_date }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Per Credit') }}:</th>
                        <td>
                            <span class="badge bg-{{ $fee->is_per_credit ? 'info' : 'secondary' }}">
                                {{ $fee->is_per_credit ? __('Yes') : __('No') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Mandatory') }}:</th>
                        <td>
                            <span class="badge bg-{{ $fee->is_mandatory ? 'danger' : 'success' }}">
                                {{ $fee->is_mandatory ? __('Mandatory') : __('Optional') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Payment Statistics') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Total Students') }}:</th>
                        <td>{{ $fee->studentFees->count() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Paid')                        <td>{{ }}:</th>
 $fee->studentFees->where('payment_status', 'paid')->count() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Unpaid') }}:</th>
                        <td>{{ $fee->studentFees->where('payment_status', 'unpaid')->count() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Partial') }}:</th>
                        <td>{{ $fee->studentFees->where('payment_status', 'partial')->count() ?? 0 }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($fee->description)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Description') }}</h5>
    </div>
    <div class="card-body">
        {{ $fee->description }}
    </div>
</div>
@endif
@endsection
