@extends('layouts.app')

@section('title', __('Payment') . ' ' . __('Details'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Payment') }} {{ __('Details') }}</h2>
    <div>
        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> {{ __('Edit') }}
        </a>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Payment Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Receipt Number') }}:</th>
                        <td>{{ $payment->receipt_number }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Amount') }}:</th>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Payment Method') }}:</th>
                        <td>
                            @switch($payment->payment_method)
                                @case('cash')
                                    <span class="badge bg-success">Cash</span>
                                    @break
                                @case('card')
                                    <span class="badge bg-info">Card</span>
                                    @break
                                @case('bank_transfer')
                                    <span class="badge bg-warning">Bank Transfer</span>
                                    @break
                                @case('online')
                                    <span class="badge bg-primary">Online</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $payment->payment_method }}</span>
                            @endswitch
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Payment Date') }}:</th>
                        <td>{{ $payment->payment_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Student Information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Student ID') }}:</th>
                        <td>{{ $payment->student->student_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}:</th>
                        <td>{{ $payment->student->first_name ?? '' }} {{ $payment->student->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Department') }}:</th>
                        <td>{{ $payment->student->department->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Email') }}:</th>
                        <td>{{ $payment->student->email ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
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
                        <th width="200">{{ __('Fee Name') }}:</th>
                        <td>{{ $payment->studentFee->fee->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Amount Due') }}:</th>
                        <td>{{ number_format($payment->studentFee->amount_due ?? 0, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($payment->notes)
<div class="card">
    <div class="card-header">
        <h5>{{ __('Notes') }}</h5>
    </div>
    <div class="card-body">
        {{ $payment->notes }}
    </div>
</div>
@endif
@endsection
