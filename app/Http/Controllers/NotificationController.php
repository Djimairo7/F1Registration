<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function destroy($id)
    {
        $message = Notification::find($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully');
    }
}
