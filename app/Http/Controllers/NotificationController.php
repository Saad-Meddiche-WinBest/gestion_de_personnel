<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function mark_notification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function get_events_with_today_date()
    {
        $persons = Event::whereDate('date', Carbon::today())->get();
        return response()->json(['notifications' => count($persons)]);
    }
}
