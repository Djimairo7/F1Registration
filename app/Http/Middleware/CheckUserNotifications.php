<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $notifications = Notification::where('user_id', $user->id)->get();

            //*insert notification
            $notification = [
                'user_id' => $user->id,
                'message' => 'This is a test notification.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // Notification::insert($notification);

            // Share the notifications with all views
            view()->share('notifications', $notifications);
        }

        return $next($request);
    }
}
