<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UsersPhoneNumber extends Model
{
    use Notifiable;

    protected $table = "users_phone_number";
    protected $fillable = [
        'phone_number'
    ];

    public function routeNotificationForTwilio()
    {
        return $this->phone_number;
    }
}
