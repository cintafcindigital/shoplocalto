<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreelistingMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $sendData;
    public function __construct($email_content)
    {
        $this->sendData = $email_content;
        $this->subject = 'Welcome to My Health Squad - Complete Your Account';
    }

    public function build()
    {
        return $this->from('account@myhealthsquad.ca','My Health Squad')
                ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                ->subject($this->subject)
                ->view('emails.freelisting_payment')->with(['mailData' => $this->sendData]);
    }
}