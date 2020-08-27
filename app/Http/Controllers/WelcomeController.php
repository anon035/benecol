<?php

namespace App\Http\Controllers;

use App\Article;
use App\MatchManager;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $matchManager = new MatchManager();
        $upcoming = $matchManager->getAllMatches(MatchManager::UPCOMING, 8);
        $past = $matchManager->getAllMatches(MatchManager::PAST, 5, 'desc');

        return view('welcome', [
            'articles' => Article::orderBy('order', 'desc')->take(3)->get(),
            'upcomingMatches' => $upcoming,
            'lastResults' => $past
        ]);
    }
}
