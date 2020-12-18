<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerifyLink extends Mailable
{
    use Queueable, SerializesModels;

    protected $sendData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
       $this->sendData = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('account@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject('Verify Email Address')
        ->view('emails.user_verify_link')->with([
                        'name' => $this->sendData['name'],
                    ]);
    }
}
