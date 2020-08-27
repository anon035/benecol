<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'futbalnet_path', 'trainings_visible'
    ];

    public function users() {
        return $this->hasMany('App\User')->withTrashed();
    }

    public function events() {
        return $this->hasMany('App\Event');
    }

    public function attendancies() {
        return $this->hasMany('App\Attendance');
    }
}
