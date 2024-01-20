<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserTagProposalNotification extends Notification
{
    use Queueable;
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'tag_id' => $this->model->user_id,
            'proposal_id' => $this->model->proposal_id,
            'proposal_title' => $this->model->proposal->project_title,
        ];
    }
}
