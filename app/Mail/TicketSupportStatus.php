<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketSupportStatus extends Mailable
{
    use Queueable, SerializesModels;
    protected $sendData;
    protected $othersData;
    public function __construct($request,$otherData)
    {
        $this->sendData = $request;
        $this->othersData = $otherData;
    }

    public function build()
    {
        return $this->from('account@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject('My Health Squad - '.ucwords(str_ireplace('-',' ',$this->sendData['subject'])).' - '.$this->sendData['ticket_id'])
        ->view('emails.'.$this->othersData['othersPage'])->with(['mailData' => $this->sendData,'othersData' => $this->othersData]);
    }
}