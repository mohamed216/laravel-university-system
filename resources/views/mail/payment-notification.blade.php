<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { padding: 10px; text-align: center; font-size: 12px; color: #666; }
        .amount { font-size: 24px; font-weight: bold; color: #27ae60; }
        .details { background: white; padding: 15px; margin: 15px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $type === 'receipt' ? 'Payment Receipt' : 'Payment Reminder' }}</h1>
        </div>
        <div class="content">
            <p>Hello {{ $student->name }},</p>
            
            @if($type === 'receipt')
            <p>Thank you for your payment! Here is your receipt:</p>
            
            <div class="details">
                <p><strong>Payment Details:</strong></p>
                <p>Amount: <span class="amount">${{ number_format($payment->amount, 2) }}</span></p>
                <p>Date: {{ $payment->payment_date->format('F j, Y') }}</p>
                <p>Method: {{ ucfirst($payment->payment_method) }}</p>
                <p>Reference: #{{ $payment->id }}</p>
            </div>
            
            <p>Your payment has been successfully processed.</p>
            @else
            <p>This is a friendly reminder about your outstanding balance.</p>
            
            <div class="details">
                <p><strong>Outstanding Balance:</strong></p>
                <p>Amount: <span class="amount">${{ number_format($payment->amount, 2) }}</span></p>
                <p>Due Date: {{ $payment->due_date->format('F j, Y') }}</p>
            </div>
            
            <p>Please make your payment as soon as possible to avoid any late fees.</p>
            @endif
            
            <p>If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>The University System Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
