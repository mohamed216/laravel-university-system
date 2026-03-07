@extends('layouts.app')

@section('title', __('Payments'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Payments') }}</h2>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="receipt_number" class="form-control" placeholder="{{ __('Receipt Number') }}" value="{{ request('receipt_number') }}">
            </div>
            <div class="col-md-3">
                <select name="payment_method" class="form-select">
                    <option value="">{{ __('Payment Method') }}</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                    <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="online" {{ request('payment_method') == 'online' ? 'selected' : '' }}>Online</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('Receipt Number') }}</th>
                    <th>{{ __('Student') }}</th>
                    <th>{{ __('Fee') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Payment Method') }}</th>
                    <th>{{ __('Payment Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->receipt_number }}</td>
                    <td>{{ $payment->student->first_name ?? '' }} {{ $payment->student->last_name ?? '' }}</td>
                    <td>{{ $payment->studentFee->fee->name ?? '-' }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
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
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        <a href="{{ route('payments.receipt', $payment) }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="bi bi-receipt"></i>
                        </a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline">
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
                    <td colspan="7" class="text-center">{{ __('No data found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $payments->links() }}
    </div>
</div>
@endsection
