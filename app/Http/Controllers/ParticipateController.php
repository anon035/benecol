<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Facades\Auth;

class ParticipateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($participate, Event $event)
    {
        $participant = $event->participants()->where('player_id', Auth::user()->id)->first();
        if (!$participant->user_submitted) {
            $participant->user_submitted = true;
            if ($participate == 'yes') {
                $participant->is_present = true;
            } else {
                $participant->is_present = false;
            }
            $participant->save();
        }
        return redirect()->route('events', ['type' => $event->event_type]);
    }
}
