<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class DocumentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('documents', ['documents' => Document::orderBy('order', 'asc')->get()]);
    }
}
