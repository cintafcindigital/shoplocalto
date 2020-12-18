<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PatientAutoResponderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = '';
    public $toEmail = '';
    public $currentProfile = '';
    public $profiles = '';
    public $blogs = '';
    public function __construct($name,$toEmail,$currentProfile,$profiles,$blogs)
    {
        $this->name = $name;
        $this->toEmail = $toEmail;
        $this->currentProfile = $currentProfile;
        $this->profiles = $profiles;
        $this->blogs = $blogs;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('Your messages have been sent')
                    ->view('emails.patient_auto_responder')
                    ->with([
                        'name' => $this->name,
                        'toEmail' => encrypt($this->toEmail),
                        'currentProfile' => $this->currentProfile,
                        'profiles' => $this->profiles,
                        'blogs' => $this->blogs,
                    ]);
    }
}