<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketSupportNew extends Mailable
{
    use Queueable, SerializesModels;
    protected $sendData;
    public function __construct($request)
    {
        $this->sendData = $request;
    }

    public function build()
    {
        return $this->from('account@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject('My Health Squad - '.ucwords(str_ireplace('-',' ',$this->sendData['subject'])).' - '.$this->sendData['ticket_id'])
        ->view('emails.tickets_new')->with(['mailData' => $this->sendData]);
    }
}