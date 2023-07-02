<?php

namespace App\Traits;
use App\Models\UserAlert;
use App\Models\User;
use Illuminate\Support\Facades\Http;

trait push_notification
{

    public function send_notification( $title , $body , $alert_text , $alert_link , $type , $user_id, $add_to_alerts = true, $data = null)
    {
        $user = User::findOrFail($user_id); 

        if($add_to_alerts){
            $userAlert = UserAlert::create([
                'alert_text' => $alert_text,
                'alert_link' => $alert_link,
                'type' => $type,
            ]);

            $userAlert->users()->sync($user_id);
        }

        Http::withHeaders([
            'Authorization' => 'key=' . config('app.fcm_token_key'),
            'Content-Type' =>   'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $user->fcm_token,
            "collapse_key" => "type_a",
            "data" => [
                "type" => $type,
                "status" => $data,
            ],
            "notification" => [
                "title"=> $title,
                "body" => $body
            ]
        ]); 
    }
}
