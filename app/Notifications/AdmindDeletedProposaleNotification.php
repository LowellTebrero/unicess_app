<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdmindDeletedProposaleNotification extends Notification
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



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {


        return [
            'admin_deleted_proposal' => $this->proposalDelete->id,
            'admin_deleted_project_title' => $this->proposalDelete->project_title,
        ];

    }
}
