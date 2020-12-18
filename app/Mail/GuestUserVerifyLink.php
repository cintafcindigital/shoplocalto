<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestUserVerifyLink extends Mailable
{
    use Queueable, SerializesModels;

    public $objectData = array();
    public $subject = '';
    public $viewmail = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getFullData,$subject,$viewmail)
    {
        $this->objectData = $getFullData;
        $this->subject = $subject;
        $this->viewmail = $viewmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /* echo"<pre>";
         print_r($this->objectData);
         print_r($this->companyData);
         die;*/
         return $this->from('account@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject($this->subject)
        ->view('emails.'.$this->viewmail)->with([
                        'name' => $this->objectData['name'],
                        'email' => bcrypt($this->objectData['email']),
                        'id' => base64_encode($this->objectData['id']),
                        'url' => url('/'),
                    ]);
    }
}
