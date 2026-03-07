<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GradeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $student,
        public $grade,
        public $course
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Grade Posted - ' . $this->course->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.grade-notification',
        );
    }
}
