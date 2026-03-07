<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $student,
        public $payment,
        public $type // 'receipt' or 'reminder'
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->type === 'receipt' 
            ? 'Payment Receipt - $' . number_format($this->payment->amount, 2)
            : 'Payment Reminder - Outstanding Balance';
            
        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.payment-notification',
        );
    }
}
