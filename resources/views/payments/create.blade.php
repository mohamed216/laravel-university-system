@extends('layouts.app')

@section('title', __('Add') . ' ' . __('Payment'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ __('Add') }} {{ __('Payment') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student') }} *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select {{ __('Student') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Student Fee') }} *</label>
                    <select name="student_fee_id" class="form-select" required>
                        <option value="">Select {{ __('Fee') }}</option>
                        @foreach($studentFees as $studentFee)
                            <option value="{{ $studentFee->id }}">{{ $studentFee->fee->name ?? '' }} - {{ number_format($studentFee->amount_due, 2) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Receipt Number') }}</label>
                    <input type="text" name="receipt_number" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Amount') }} *</label>
                    <input type="number" name="amount" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Payment Method') }}</label>
                    <select name="payment_method" class="form-select">
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Payment Date') }}</label>
                    <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('Notes') }}</label>
                    <textarea name="notes" class="form-control" rows="2"></textarea>
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
