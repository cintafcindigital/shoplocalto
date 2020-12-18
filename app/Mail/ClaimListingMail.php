<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;



class ClaimListingMail extends Mailable

{

    use Queueable, SerializesModels;

    public $name = '';

    public $toEmail = '';

    public function __construct($name = '',$toEmail = '')

    {

        $this->name = $name;

        $this->toEmail = $toEmail;

    }



    public function build()

    {

        return $this->from('no-reply@shoplocalto.ca','ShopLocalTo')

                    ->bcc(env('ADMIN_EMAIL'),'ShopLocalTo')

                    ->subject('Claim your shoplocalto listing')

                    ->view('emails.claim_listing')

                    ->with(['name' => $this->name,'toEmail' => $this->toEmail]);

    }

}