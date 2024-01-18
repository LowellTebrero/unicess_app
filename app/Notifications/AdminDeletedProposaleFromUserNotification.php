<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminDeletedProposaleFromUserNotification extends Notification
{
    use Queueable;
    public $proposal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'admin_recieve_deleted_proposal' => $this->proposal->id,
            'admin_recieve_deleted_project_title' => $this->proposal->project_title,
        ];
    }
}
