<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Category;

class NotificationsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($message = null)
    {
        $trainers = User::where('user_type', 'trainer')->orderBy('surname')->get();
        $categories = Category::with([
            'users' => function ($query) {
                $query->where('user_type', 'player')->whereNull('deleted_at')->orderBy('surname')->orderBy('name');
            }
        ])->whereHas('users', function ($query) {
            $query->where('user_type', 'player')->orderBy('surname')->orderBy('name');
        })->orderBy('id')->get();
        return view('admin.notifications', [
            'message' => $message,
            'trainers' => $trainers,
            'categories' => $categories
        ]);
    }
}
