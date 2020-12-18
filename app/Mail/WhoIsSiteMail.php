<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WhoIsSiteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $view = 'who_is_site';
    public $subject = 'Who is My Health Squad?';
    public $toEmail = '';
    public function __construct($toEmail = '')
    {
        $this->toEmail = $toEmail;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject($this->subject)
                    ->view('emails.'.$this->view)
                    ->with([
                        'toEmail' => encrypt($this->toEmail)
                    ]);
    }
}