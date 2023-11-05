<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ProposalNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNewProposalNotification
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
        $partners = User::whereHas('roles', function ($query) {
            $query->where('id', 5);
        })->get();

    Notification::send($partners, new ProposalNotification($event->proposals));
    }
}
