<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConditionsOfContractMail extends Mailable
{
    use Queueable, SerializesModels;
    public $view = 'contract_signing';
    public $subject = 'GENERAL CONDITIONS OF CONTRACT';
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
                    ->with(['toEmail' => $this->toEmail]);
    }
}