<?php

namespace App\Http\Controllers;

use App\User;

class TrainersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id = null)
    {
        if ($id) {
            return $this->show(User::findOrFail($id));
        }
        return view('trainers', ['trainers' => User::where('user_type', 'trainer')->orderBy('surname')->orderBy('name')->get()]);
    }

    public function show($user) {
        if ($user->user_type != 'trainer') {
            abort(404);
        }
        return view('trainer', ['trainer' => $user]);
    }
}
