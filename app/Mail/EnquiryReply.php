<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryReply extends Mailable
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
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject('My Health Squad Support')
        ->view('emails.enquiry_reply')->with([
                        'name' => $this->sendData['name'],
                        'content' => $this->sendData['message'],
                        'fileData' => $this->sendData['fileData'],
                    ]);
    }
}
