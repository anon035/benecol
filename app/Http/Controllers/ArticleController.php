<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Article $article)
    {
        return view('article-single', ['article' => $article]);
    }
}
