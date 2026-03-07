<!DOCTYPE html>
<html>
<head>
    <title>Finance Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #2c3e50; color: white; }
        .header { text-align: center; margin-bottom: 20px; }
        .summary { margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Finance Report</h1>
        <p>Period: {{ $dateFrom }} to {{ $dateTo }}</p>
        <p>Generated on {{ date('Y-m-d H:i:s') }}</p>
    </div>
    
    <div class="summary">
        <strong>Summary:</strong><br>
        Total Fees: ${{ number_format($totalFees, 2) }}<br>
        Total Collected: ${{ number_format($totalPayments, 2) }}<br>
        Outstanding: ${{ number_format($outstanding, 2) }}
    </div>
    
    <h3>Monthly Fees</h3>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyFees as $fee)
            <tr>
                <td>{{ $fee->month }}</td>
                <td>${{ number_format($fee->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <h3 style="margin-top: 20px;">Monthly Collections</h3>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyPayments as $payment)
            <tr>
                <td>{{ $payment->month }}</td>
                <td>${{ number_format($payment->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
