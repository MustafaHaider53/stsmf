<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     */
    public function build()
{
    \Log::info('Using view: emails.student_registered'); // Debug statement

    // Check if the view exists
    if (!view()->exists('emails.student_registered')) {
        \Log::error('View [emails.student_registered] does not exist.');
    }

    return $this->view('emails.student_registered')
                ->with(['student' => $this->student])
                ->subject('Welcome to Our Application');
                
}

}
