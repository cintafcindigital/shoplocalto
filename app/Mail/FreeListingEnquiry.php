<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreeListingEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $toEmail = '';
    public $business_name = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toEmail,$business_name)
    {
        $this->toEmail       = $toEmail;
        $this->business_name = $business_name;
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
        ->subject('You have a lead waiting for you!')
        ->view('emails.free_listing_enquiry',['toEmail' => encrypt($this->toEmail),'business_name' => $this->business_name]);
    }
}
