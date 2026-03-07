@extends('layouts.app')

@section('title', __('Edit') . ' ' . __('Payment'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Edit') }} {{ __('Payment') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student') }} *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select {{ __('Student') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student Fee') }} *</label>
                    <select name="student_fee_id" class="form-select" required>
                        <option value="">Select {{ __('Fee') }}</option>
                        @foreach($studentFees as $studentFee)
                            <option value="{{ $studentFee->id }}" {{ $payment->student_fee_id == $studentFee->id ? 'selected' : '' }}>{{ $studentFee->fee->name ?? '' }} - {{ number_format($studentFee->amount_due, 2) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Receipt Number') }}</label>
                    <input type="text" name="receipt_number" class="form-control" value="{{ $payment->receipt_number }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Amount') }} *</label>
                    <input type="number" name="amount" class="form-control" step="0.01" value="{{ $payment->amount }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Payment Method') }}</label>
                    <select name="payment_method" class="form-select">
                        <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ $payment->payment_method == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="bank_transfer" {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="online" {{ $payment->payment_method == 'online' ? 'selected' : '' }}>Online</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Payment Date') }}</label>
                    <input type="date" name="payment_date" class="form-control" value="{{ $payment->payment_date }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Notes') }}</label>
                    <textarea name="notes" class="form-control" rows="2">{{ $payment->notes }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
