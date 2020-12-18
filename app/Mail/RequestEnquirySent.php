<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestEnquirySent extends Mailable
{
    use Queueable, SerializesModels;
    public $objectData  = array();
    public $companyData = array();
    public $subject     = '';
    public $viewmail    = '';
    public $roleType    = '';
    public $toEmail     = '';
    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($getFullData,$companyData,$subject,$viewmail,$roleType,$toEmail = '')
    {
        $this->objectData   = $getFullData;
        $this->companyData  = $companyData;
        $this->subject      = $subject;
        $this->viewmail     = $viewmail;
        $this->roleType     = $roleType;
        $this->toEmail      = $toEmail;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        /* echo"<pre>";
        print_r($this->objectData);
        print_r($this->companyData);
        die;*/
        return $this->from('no-reply@myhealthsquad.ca','My Health Squad')
                    ->bcc(env('ADMIN_EMAIL'),'My Health Squad')
        ->subject(@$this->subject)
        ->view('emails.'.$this->viewmail)->with([
                        'roleType' => @$this->roleType,
                        'name' => @$this->objectData['name'],
                        'email' => @$this->objectData['email'],
                        'number_of_guests' => @$this->objectData['number_of_guests'],
                        'event_date' => @$this->objectData['event_date'],
                        'phone' => @$this->objectData['phone'],
                        'comment' => @$this->objectData['comment'],
                        'vendor_id' => @$this->companyData[0]->vendor_id,
                        'business_name' => @$this->companyData[0]->business_name,
                        'category_title' => @$this->companyData[0]->title,
                        'telephone' => @$this->companyData[0]->telephone,
                        'business_address' => @$this->companyData[0]->business_address,
                        'province' => @$this->companyData[0]->province,
                        'country' => @$this->companyData[0]->country,
                        'toEmail' => encrypt($this->toEmail),
                    ]);
    }
}