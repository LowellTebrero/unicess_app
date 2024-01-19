<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSubmitEvaluationToAdminNotification extends Notification
{
    use Queueable;
    public $evaluate;

    public function __construct($evaluate)
    {
        $this->evaluate = $evaluate;
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
            'evaluation_id' => $this->evaluate->id,
            'evaluation_user_id' => $this->evaluate->user_id,

        ];
    }
}
