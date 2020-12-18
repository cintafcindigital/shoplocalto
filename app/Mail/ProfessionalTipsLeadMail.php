<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessionalTipsLeadMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $view = 'lead_follow_up';
    public $subject = 'My Health Squad Health Professional tips - lead follow up';
    public $toEmail = '';
    public function __construct($name = '',$view = '',$subject = '',$toEmail = '')
    {
        $this->name = $name;
        if($view != '' && !empty($view))
            $this->view = $view;
        if($subject != '' && !empty($subject))
            $this->subject = $subject;
        $this->toEmail = $toEmail;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject($this->subject)
                    ->view('emails.'.$this->view)
                    ->with([
                        'name' => $this->name,
                        'toEmail' => encrypt($this->toEmail)
                    ]);
    }
}