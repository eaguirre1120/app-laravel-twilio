<?php

namespace App\Notifications;

use App\Channels\Messages\TwilioMessage;
use App\Channels\TwilioChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\UsersPhoneNumber;

class TwilioSms extends Notification
{
    use Queueable;

    public $userPhoneNumber;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UsersPhoneNumber $userPhoneNumber, $message)
    {
        $this->userPhoneNumber = $userPhoneNumber;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array|mixed
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    /**
     * Get the Twilio representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return App\Channels\Messages\TwilioMessage
     */
    public function toTwilio($notifiable)
    {
        // $message = 'User registration successful!!';
        return (new TwilioMessage)
            ->content($this->message);
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
            //
        ];
    }
}
