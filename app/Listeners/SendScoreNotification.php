<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendScoreNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $users = User::where('isAdmin', 1)->get();
        $scoreUser = User::find($event->score->user_id);
        $raceName = ucwords(str_replace('-', ' ', $event->score->race_name));
        $name = ucwords("{$scoreUser->profile->first_name} {$scoreUser->profile->last_name}");

        foreach ($users as $user) {
            $notification = [
                'user_id' => $user->id,
                'message' => "$name has added a new time to $raceName: {$event->score->score}",
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Notification::insert($notification);
        }
    }
}
