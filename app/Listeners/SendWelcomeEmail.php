<?php

namespace App\Listeners;
use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $data = array('name'=>$user->name, 'email'=>$user->email);
        \Mail::send('emails.new_user', $data, function($message) use ($user) {
            $message->to($user->email);
            $message->subject('Welcome to My Health Squad');
        });
    }
}
