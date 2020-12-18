<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    protected $sendData;
    public $payAmount;
    public $subject = '';
    public $payType = '';
    public function __construct($request,$payAmount,$subject,$payType)
    {
        $this->sendData = $request;
        $this->payAmount = $payAmount;
        $this->subject = $subject;
        $this->payType = $payType;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject($this->subject.' - My Health Squad')
                    ->view('emails.vendorMailToAdmin')
                    ->with(['mailData' => $this->sendData, 'payAmount' => $this->payAmount, 'subject' => $this->subject, 'payType' => $this->payType]);
    }
}