<?php

use App\Models\Notification;

function sendNotification($user_id, $type, $message)
{
    Notification::create([
        'user_id' => $user_id,
        'type' => $type,
        'message' => $message,
    ]);
}
