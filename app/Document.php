<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name', 'path'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($document) {
            $oldDocumentPath = str_replace('/project/', '/web/', base_path($document->path));
            if (file_exists($oldDocumentPath)) {
                unlink($oldDocumentPath);
            }
        });
    }
}
