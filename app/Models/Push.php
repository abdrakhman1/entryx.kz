<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Push
{
    public static function send($title, $body, $user_id)
    {
        $user = User::find($user_id);
        $request = [
            'notification' => [
                'title' => $title,
                'body' => $body,
                'priority' => 'HIGH',
                'sound' => 'default'
            ],
            'data' => [
                'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            ],
            'to' => '/topics/' . $user->id
        ];

        $response =  Http::withHeaders([
            'Authorization' => 'key=AAAAafTUxAc:APA91bGPPALwQiQxyCQLbQNuyWF4DMS-dz_-BbmIMNgLPZ_SP8Fh6k-6tLO6ctUaNkWypPV4UO4lxnA9loQfhomPVe2RavJgkox8oIUro7jdj7l4WDXC5wZKxGHPaTTe6Ik3lmwc6r2e',
            'Content-Type' => 'application/json'
        ])->post('https://fcm.googleapis.com/fcm/send', $request);

        usleep(10000);

        return $response;
    }

    /**
     * @type - type of user role. 4 - waiter, 5 - smoke master
     */
    public static function send_message_to_waiters($title = 'test', $body = 'test', $type = 1) {
        $role_id = 4;
        if ($type == 4) {
            $role_id = 5;
        }

        $waiters = User::where('role_id', $role_id)->where('status', 11)->get();
        foreach ($waiters as $waiter) {
            Push::send($title, $body, $waiter->phone);
        }
        return $waiters;
    }
}
