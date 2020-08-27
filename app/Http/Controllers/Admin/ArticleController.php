<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.article-list', ['articles' => Article::orderBy('order', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article-form', ['article' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $file = $request->file('photo');
        $tempPath = $file->path();
        $dbPath = 'public_files/article_photos/' . time() . $file->hashName();
        $photoPath = str_replace('/project/', '/web/', base_path($dbPath));
        if (!move_uploaded_file($tempPath, $photoPath)) {
            throw new FileUploadException('Nahrávanie fotky zlyhalo');
        }
        Article::create(['title' => $request->title, 'content' => $request->content ?? '(Chýbajúci text novinky)', 'photo_path' => $dbPath]);
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return redirect()->route('article.single', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.article-form', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if($file = $request->file('photo')){
            $tempPath = $file->path();
            $dbPath = 'public_files/article_photos/' . time() . $file->hashName();
            $photoPath = str_replace('/project/', '/web/', base_path($dbPath));
            if (!move_uploaded_file($tempPath, $photoPath)) {
                throw new FileUploadException('Nahrávanie fotky zlyhalo');
            }
            $article->photo_path = $dbPath;
        }
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
        return redirect()->route('article.index');
    }

    public function reorder(Request $request)
    {
        $reorder = $request->reorder;
        foreach ($reorder as $id => $order) {
            $document = Article::find($id);
            if ($document) {
                $document->order = $order;
                $document->save();
            }
        }
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index');
    }
}
