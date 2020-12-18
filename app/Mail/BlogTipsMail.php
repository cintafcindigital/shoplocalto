<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;



class BlogTipsMail extends Mailable

{

    use Queueable, SerializesModels;

    public $name        = '';

    public $view        = 'submitting_a_blog';

    public $subject     = 'ShopLocalTo - submitting a blog';

    public $blogs       = [];

    public $toEmail     = '';

    public function __construct($name = '',$view = '',$subject = '',$blogs = [],$toEmail = '')

    {

        $this->name = $name;

        if(!empty($view) && $view != '')

            $this->view = $view;

        if(!empty($subject) && $subject != '')

            $this->subject = $subject;

        $this->blogs = $blogs;

        $this->toEmail = $toEmail;

    }



    public function build()

    {

        return $this->from('no-reply@shoplocalto.ca','ShopLocalTo')

                    ->bcc(env('ADMIN_EMAIL'),'ShopLocalTo')

                    ->subject($this->subject)

                    ->view('emails.'.$this->view)

                    ->with([

                        'name' => $this->name,

                        'blogs' => $this->blogs,

                        'toEmail' => encrypt($this->toEmail)

                    ]);

    }

}