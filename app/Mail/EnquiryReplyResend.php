<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryReplyResend extends Mailable
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
        return $this->from('account@perfectweddingday.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject('New lead myhealthsquad.ca')
        ->view('emails.enquiry_replyresend')->with([
                        'business_name' => $this->sendData['business_name'],
                        'business_category' => $this->sendData['business_category'],
                        'business_province' => $this->sendData['business_province'],
                        'enq_name' => $this->sendData['enq_name'],
                        'enq_email' => $this->sendData['enq_email'],
                        'enq_phone' => $this->sendData['enq_phone'],
                        'enq_message' => $this->sendData['enq_message'],
                        'enq_eventdate' => $this->sendData['enq_eventdate'],
                        'enq_url' => $this->sendData['enq_url'],

                    ]);
    }
}
