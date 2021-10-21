<?php

namespace App\Http\Controllers;

use App\UsersPhoneNumber;
use Illuminate\Http\Request;
use Twilio\Rest\Client;


class HomeController extends Controller
{
    public function storePhoneNumber(Request $request)
    {
        $validateData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number|numeric'
        ]);
        $userPhoneNumber = new UsersPhoneNumber($request->all());
        $userPhoneNumber->save();

        $this->sendMessage('User registration successful!!', $request->phone_number);

        return back()->with(['success' => "{$request->phone_number} registered"]);
    }

    public function show()
    {
        $users = UsersPhoneNumber::all();
        return view('welcome', ['users' => $users]);
    }

    public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }

    private function sendMessage($message, $recipients)
    {
        $accountId = config('notification.twilio.id');
        $authToken = config('notification.twilio.auth_token');
        $twilioNumber = config('notification.twilio.number');
        // dd($accountId, $authToken, $twilioNumber);
        $twilio = new Client($accountId, $authToken);

        $twilio->messages->create($recipients, ['from' => $twilioNumber, 'body' => $message]);
    }
}
