<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class SwitchNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $user->notifications_on = $request->notifications_on;
        $user->save();
        return redirect()->route('player.profile');
    }
}
