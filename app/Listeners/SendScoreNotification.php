<?php

namespace App\Listeners;

use App\Events\ScoreCreated;
use App\Events\ScoreUpdated;
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

        foreach ($users as $user) {
            $notification = [
                'user_id' => $user->id,
                'message' => "{$scoreUser->username} has added a new time to {$event->score->race_name}: {$event->score->score}",
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Notification::insert($notification);
        }
    }
}
