<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $review_cc  = '';
    public $vendorLogo = '';
    public $vendorName = '';
    public $userName   = '';
    public $messages   = '';
    public $reviewLink = '';
    public $baseUrl    = '';
    public $address    = '';
    public $subject    = '';
    public $pageName   = '';
    public $toEmail    = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($review_cc,$vendorLogo,$vendorName,$userName,$messages,$reviewLink,$baseUrl,$address,$subject,$pageName,$toEmail = '')
    {
        $this->review_cc  = $review_cc;
        $this->vendorLogo = $vendorLogo;
        $this->vendorName = $vendorName;
        $this->userName   = $userName;
        $this->messages   = $messages;
        $this->reviewLink = $reviewLink;
        $this->baseUrl    = $baseUrl;
        $this->address    = $address;
        $this->subject    = $subject;
        $this->pageName   = $pageName;
        $this->toEmail    = $toEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from($this->review_cc,'My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject($this->subject)
        ->view('emails.'.$this->pageName)->with([
                        'vendorLogo' => $this->vendorLogo,
                        'vendorName' => $this->vendorName,
                        'userName'   => $this->userName,
                        'messages'   => $this->messages,
                        'reviewLink' => $this->reviewLink,
                        'baseUrl'    => $this->baseUrl,
                        'address'    => $this->address,
                        'toEmail'    => encrypt($this->toEmail),
                    ]);
    }
}