<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorMakeChangesMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $toEmail = '';
    public function __construct($name,$toEmail = '')
    {
        $this->name = $name;
        $this->toEmail = $toEmail;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('Changes to your listing')
                    ->view('emails.changes_your_listing')
                    ->with(['name' => $this->name,'toEmail' => $this->toEmail]);
    }
}