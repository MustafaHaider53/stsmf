<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Result;

class RemarksMail extends Mailable
{
    use Queueable, SerializesModels;

    public $result;

    /**
     * Create a new message instance.
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function build()
    {
        return $this->view('emails.remarks')
                    ->with(['result' => $this->result])
                    ->subject('Remarks on Your Result');
        
    }

}
