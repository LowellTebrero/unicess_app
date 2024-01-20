<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminDeleteUserEvaluationNotification extends Notification
{
    use Queueable;
    public $delete;

    public function __construct($delete)
    {
        $this->delete = $delete;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'deleted_evaluation_id' => $this->delete->id,
            'deleted_evaluation_user_id' => $this->delete->user_id,

        ];
    }
}
