<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorAfterPayment extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $email = '';
    public function __construct($name = '',$email = '')
    {
        $this->name     = $name;
        $this->email    = $email;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('Getting started with My Health Squad')
                    ->view('emails.starting_with_our_team')
                    ->with(['name' => $this->name,'toEmail' => encrypt($email)]);
    }
}