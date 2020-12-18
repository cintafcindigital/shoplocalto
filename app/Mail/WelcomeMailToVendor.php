<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMailToVendor extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('Getting started with My Health Squad')
                    ->view('emails.new_user')
                    ->with(['name' => $this->name]);
    }
}