<?php

return [

    'twilio' => [
        'id' => env('TWILIO_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'number' => env('TWILIO_NUMBER', 'us-east-1'),
    ],

];
