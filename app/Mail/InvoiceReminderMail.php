<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $review_cc  = '';
    public $vendorLogo = '';
    public $vendorName = '';
    public $compName   = '';
    public $messages   = '';
    public $paymentLink = '';
    public $baseUrl    = '';
    public $address    = '';
    public $subject    = '';
    public $pageName   = '';

    /**
    * Create a new message instance.
    *
    * @return void
    */
    public function __construct($review_cc,$vendorLogo,$vendorName,$compName,$messages,$paymentLink,$baseUrl,$address,$subject,$pageName)
    {
        $this->review_cc  = $review_cc;
        $this->vendorLogo = $vendorLogo;
        $this->vendorName = $vendorName;
        $this->compName   = $compName;
        $this->messages   = $messages;
        $this->paymentLink = $paymentLink;
        $this->baseUrl    = $baseUrl;
        $this->address    = $address;
        $this->subject    = $subject;
        $this->pageName   = $pageName;
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
                        'compName'   => $this->compName,
                        'messages'   => $this->messages,
                        'paymentLink' => $this->paymentLink,
                        'baseUrl'    => $this->baseUrl,
                        'address'    => $this->address,
                    ]);
    }
}