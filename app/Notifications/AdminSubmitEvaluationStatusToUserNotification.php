<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSubmitEvaluationStatusToUserNotification extends Notification
{
    use Queueable;

    public $evaluatuion;

    public function __construct($evaluatuion)
    {
        $this->evaluatuion = $evaluatuion;
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
            'evaluated_id' => $this->evaluatuion->id,
            'evaluated_user_id' => $this->evaluatuion->user_id,
        ];
    }
}
