<?php

namespace App;

use stdClass;

class Gallery
{

    private $fb;

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
            'app_id' => '',
            'app_secret' => '',
            'default_graph_version' => 'v2.10',
            'default_access_token' => '',
        ]);
    }

    public function getPhotos($albumId, $url = null)
    {
        if (!$url) {
            $url = '/' . $albumId . '/photos?fields=images&limit=28';
        }
        $response = $this->fb->get($url);
        $json = json_decode($response->getBody());

        $photos = [];
        if ($json  && isset($json->data)) {
            foreach ($json->data as $photo) {
                $photos[] = $photo->images[0]->source;
            }
        }

        $previousPhotos = isset($json->paging->previous) ? $this->parseUrl($json->paging->previous) : null;
        $nextPhotos = isset($json->paging->next) ? $this->parseUrl($json->paging->next) : null;

        $photosObj = new stdClass();
        $photosObj->photos = $photos;
        $photosObj->previousPhotos = $previousPhotos;
        $photosObj->nextPhotos = $nextPhotos;

        return $photosObj;
    }

    public function getAlbums($url = null)
    {
        $albums = [];
        if (!$url) {
            $url = '/me/albums?limit=100&fields=picture,name';
        }
        $response = $this->fb->get($url);
        $json = json_decode($response->getBody());
        foreach ($json->data as $album) {
            if (strpos($album->name, 'Titulné') === false && strpos($album->name, 'Profilové') === false) {
                $albumObj = new stdClass();
                $albumObj->id = $album->id;
                $albumObj->name = $album->name;
                $albumObj->picture = $album->picture->data->url;
                $albums[$album->id] = $albumObj;
            }
        }
        if (isset($json->paging->next)) {
            $albums = $albums + $this->getAlbums($this->parseUrl($json->paging->next));
        }
        return $albums;
    }

    public function getAlbumName($albumId)
    {
        $url = '/' . $albumId . '?fields=name';
        $response = $this->fb->get($url);
        $json = json_decode($response->getBody());

        return $json->name;
    }

    public function parseUrl($originalUrl)
    {
        $url = parse_url($originalUrl);
        $path = $url['path'];
        $query = $url['query'];
        $path = explode('/', trim($path, '/'));
        array_shift($path);
        $path = implode('/', $path);
        return '/' . $path . '?' . $query;
    }
}
