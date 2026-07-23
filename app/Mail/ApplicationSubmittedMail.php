<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ApplicationSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->from('faculty.recruitment@iith.ac.in', 'Faculty Recruitment IITH')->subject('Confirmation: Application Submitted Successfully')
                    ->view('emails.application_submitted');
    }
}
