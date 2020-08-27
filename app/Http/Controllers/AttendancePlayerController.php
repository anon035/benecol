<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendancePlayerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $trainings = Attendance::with('category')->where('event_type', 'training')->where('player_id', Auth::id())->latest()->get();
        $matches = Attendance::with('category')->where('event_type', 'match')->where('player_id', Auth::id())->latest()->get();
        $tournaments = Attendance::with('category')->where('event_type', 'tournament')->where('player_id', Auth::id())->latest()->get();
        return view('attendance.player', [
            'trainings' => $trainings,
            'matches' => $matches,
            'tournaments' => $tournaments
        ]);
    }
}
