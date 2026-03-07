@extends('layouts.app')

@section('title', __('Finance Report'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Finance Report</h2>
        
        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card blue">
                    <div class="card-body">
                        <h6 class="text-muted">Total Fees</h6>
                        <h3>${{ number_format($totalFees, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card green">
                    <div class="card-body">
                        <h6 class="text-muted">Total Collected</h6>
                        <h3>${{ number_format($totalPayments, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card orange">
                    <div class="card-body">
                        <h6 class="text-muted">Outstanding</h6>
                        <h3>${{ number_format($outstanding, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('reports.finance') }}" class="btn btn-secondary">Reset</a>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}">PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Monthly Fees</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($monthlyFees as $fee)
                                    <tr>
                                        <td>{{ $fee->month }}</td>
                                        <td>${{ number_format($fee->total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="2" class="text-muted text-center">No data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Monthly Collections</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($monthlyPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->month }}</td>
                                        <td>${{ number_format($payment->total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="2" class="text-muted text-center">No data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
