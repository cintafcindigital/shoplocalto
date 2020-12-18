<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessionalTipsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $view = 'professional_tips';
    public $subject = 'My Health Squad Health Professional tips - your profile';
    public $vendors = [];
    public $toEmail = '';
    public function __construct($name = '',$view = '',$subject = '',$vendors = [],$toEmail = '')
    {
        $this->name = $name;
        if(!empty($view) && $view != '')
            $this->view = $view;
        if(!empty($subject) && $subject != '')
            $this->subject = $subject;
        $this->vendors = $vendors;
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
                        'vendors' => $this->vendors,
                        'toEmail' => encrypt($this->toEmail)
                    ]);
    }
}