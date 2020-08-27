<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PlayerProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('player-profile', ['user' => Auth::user()]);
    }
}
