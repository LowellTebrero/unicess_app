<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserFollowNotification;

class SendNewUserNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        {
            $admins = User::whereHas('roles', function ($query) {
                    $query->where('id', 1);
                })->get();

            Notification::send($admins, new UserFollowNotification($event->user));
        }
    }
}
