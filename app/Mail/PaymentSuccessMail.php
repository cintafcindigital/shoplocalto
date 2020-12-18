<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $sendData;
    protected $sendData2;
    protected $updLink = '';
    protected $pageName = '';
    protected $pay_amount = '0.00';
    public function __construct($request,$request2,$pay_amount,$updLink,$pageName)
    {
        $this->sendData = $request;
        $this->sendData2 = $request2;
        $this->pay_amount = $pay_amount;
        $this->updLink = $updLink;
        $this->pageName = $pageName;
    }

    public function build()
    {
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
                    ->subject('Thank you for registration - My Health Squad')
                    ->view('emails.'.$this->pageName)
                    ->with(['mailData' => $this->sendData,'invData' => $this->sendData2,'pay_amount' => $this->pay_amount,'updLink' => $this->updLink]);
    }
}