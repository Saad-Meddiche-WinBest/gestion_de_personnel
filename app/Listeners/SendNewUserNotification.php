<?php

namespace App\Listeners;


use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;


class SendNewUserNotification
{
    public $user;
    
    public function handle($event)
    {
        $admins = User::all();
        
        Notification::send($admins, new NewUserNotification($event->user));
    }
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
     * @param  object  $event
     * @return void
     */
    
       
  
    
}
