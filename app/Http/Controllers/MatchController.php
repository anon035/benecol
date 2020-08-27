<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\MatchManager;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $category = Category::findOrFail($request->category);

        $matchManager = new MatchManager();
        
        if(!preg_match('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $category->futbalnet_path)){
            if(Auth::check() && Auth::user()->user_type == 'admin'){
                return 'Zadali ste zlú URL';
            }
            abort(404);
        }

        $html = file_get_html($category->futbalnet_path);

        $matches = $matchManager->getMatches($html);
        $points = $matchManager->getPoints($html);

        return view('matches', ['matches' => $matches, 'points' => $points, 'name' => $category->name]);
    }
    
}
