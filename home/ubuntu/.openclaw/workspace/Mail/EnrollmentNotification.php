<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnrollmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $student,
        public $course,
        public $status // 'approved' or 'rejected'
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->status === 'approved' 
            ? 'Enrollment Approved - ' . $this->course->name
            : 'Enrollment Rejected - ' . $this->course->name;
            
        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.enrollment-notification',
        );
    }
}
