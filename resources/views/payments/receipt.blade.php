<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Payment Receipt') }} - {{ $payment->receipt_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .receipt-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .receipt-total {
            font-size: 1.5em;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .receipt-container { box-shadow: none; margin: 0; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h2>{{ __('University System') }}</h2>
            <h4>{{ __('Payment Receipt') }}</h4>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="receipt-item">
                    <strong>{{ __('Receipt Number') }}:</strong> {{ $payment->receipt_number }}
                </div>
                <div class="receipt-item">
                    <strong>{{ __('Student ID') }}:</strong> {{ $payment->student->student_id ?? 'N/A' }}
                </div>
                <div class="receipt-item">
                    <strong>{{ __('Student Name') }}:</strong> {{ $payment->student->first_name ?? '' }} {{ $payment->student->last_name ?? '' }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="receipt-item">
                    <strong>{{ __('Payment Date') }}:</strong> {{ $payment->payment_date }}
                </div>
                <div class="receipt-item">
                    <strong>{{ __('Payment Method') }}:</strong> {{ $payment->payment_method }}
                </div>
                <div class="receipt-item">
                    <strong>{{ __('Status') }}:</strong> {{ __('Paid') }}
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="receipt-item receipt-total">
            <div class="row">
                <div class="col-6">{{ __('Total Amount') }}:</div>
                <div class="col-6 text-end">${{ number_format($payment->amount, 2) }}</div>
            </div>
        </div>
        
        @if($payment->notes)
        <div class="receipt-item mt-3">
            <strong>{{ __('Notes') }}:</strong> {{ $payment->notes }}
        </div>
        @endif
        
        <div class="text-center mt-5 text-muted">
            <p>{{ __('Thank you for your payment') }}</p>
            <small>{{ now()->format('Y-m-d H:i:s') }}</small>
        </div>
        
        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> {{ __('Print') }}
            </button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                {{ __('Back') }}
            </a>
        </div>
    </div>
</body>
</html>
