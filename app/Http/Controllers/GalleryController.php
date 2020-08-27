<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $albumId = null)
    {
        $photos = [];
        $gallery = new Gallery();
        if ($albumId) {
            if ($request->has('url')) {
                $photos = $gallery->getPhotos($albumId, $request->url);
            } else {
                $photos = $gallery->getPhotos($albumId);
            }
            return view('gallery', ['photos' => $photos->photos, 'previousPhotos' => $photos->previousPhotos, 'nextPhotos' => $photos->nextPhotos, 'albumId' => $albumId, 'title' => $gallery->getAlbumName($albumId)]);
        } else {
            $albums = $gallery->getAlbums();
            return view('albums', ['albums' => $albums]);
        }
    }
}
