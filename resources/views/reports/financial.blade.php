@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-dollar-sign"></i> Financial Reports</h1>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h3>${{ number_format($totalExpectedFees, 2) }}</h3>
                    <p>Total Expected</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h3>${{ number_format($totalPaid, 2) }}</h3>
                    <p>Total Paid</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h3>${{ number_format($totalPending, 2) }}</h3>
                    <p>Total Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h3>${{ number_format($totalOverdue, 2) }}</h3>
                    <p>Total Overdue</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>By Fee Type</h5>
                </div>
                <div class="card-body">
                    @if($byFeeType->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($byFeeType as $type)
                                <tr>
                                    <td><span class="badge bg-info">{{ ucfirst($type['type']) }}</span></td>
                                    <td>${{ number_format($type['total'], 2) }}</td>
                                    <td>${{ number_format($type['paid'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No data available</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Payments</h5>
                </div>
                <div class="card-body">
                    @if($recentPayments->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Receipt #</th>
                                    <th>Student</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPayments as $payment)
                                <tr>
                                    <td>{{ $payment->receipt_number }}</td>
                                    <td>{{ $payment->student->first_name ?? 'N/A' }} {{ $payment->student->last_name ?? '' }}</td>
                                    <td>${{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->payment_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No recent payments</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
