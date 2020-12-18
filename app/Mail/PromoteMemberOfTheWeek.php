<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PromoteMemberOfTheWeek extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $toEmail = '';
    public function __construct($name = '',$toEmail = '')
    {
        $this->name = $name;
        $this->toEmail = $toEmail;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('A new colleague has join the Squad')
                    ->view('emails.promote_member_of_the_week')
                    ->with(['name' => $this->name,'toEmail' => encrypt($this->toEmail)]);
    }
}