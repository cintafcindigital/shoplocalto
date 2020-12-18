<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmittingBlogMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $toEmail = '';
    public $view = 'blog_submission';
    public $subject = 'Thank you for your submission';
    public function __construct($name = '',$toEmail = '')
    {
        $this->name = $name;
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
                        'toEmail' => encrypt($this->toEmail),
                    ]);
    }
}