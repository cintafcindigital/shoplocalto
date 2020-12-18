<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBlogPublishResponderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $toEmail = '';
    public $blogLink = '';
    public function __construct($name = '',$toEmail = [])
    {
        $this->name = $name;
        $this->toEmail = isset($toEmail['email'])?$toEmail['email']:(!is_array($toEmail)?$toEmail:'');
        $this->blogLink = isset($toEmail['link'])?$toEmail['link']:'';
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('A new blog has been published')
                    ->view('emails.new_blog_submitted_auto')
                    ->with(['name' => $this->name,'toEmail' => encrypt($this->toEmail),'link' => $this->blogLink]);
    }
}