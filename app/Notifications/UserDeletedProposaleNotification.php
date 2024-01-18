<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeletedProposaleNotification extends Notification
{
    use Queueable;
    public $proposalDelete;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proposalDelete)
    {
        $this->proposalDelete = $proposalDelete;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'user_deleted_proposal_id' => $this->proposalDelete->id,
            'user_deleted_project_title' => $this->proposalDelete->project_title,
        ];
    }
}
