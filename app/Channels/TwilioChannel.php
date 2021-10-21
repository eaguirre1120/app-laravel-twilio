<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class TwilioChannel
{
    /**
     * Send the given notification
     * 
     * @param mixed $notificable
     * @param Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTwilio($notifiable);

        $to = $notifiable->routeNotificationFor('Twilio');

        $accountId = config('notification.twilio.id');
        $authToken = config('notification.twilio.auth_token');
        $twilioNumber = config('notification.twilio.number');
        // dd($accountId, $authToken, $twilioNumber);
        $twilio = new Client($accountId, $authToken);

        $twilio->messages->create($to, [
            'from' => $twilioNumber,
            'body' => $message->content
        ]);
    }
}
