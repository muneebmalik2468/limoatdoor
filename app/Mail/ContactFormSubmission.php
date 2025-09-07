<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $userMessage;  // Renamed from $message

    public function __construct($name, $email, $subject, $userMessage)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->userMessage = $userMessage;  // Renamed
    }

    public function build()
    {
        return $this->from($this->email, $this->name)
                    ->subject('New Contact Form Submission: ' . $this->subject)
                    ->view('emails.contact-submission');
    }

}
