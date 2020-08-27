<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainerPhoto extends Model
{

    protected $fillable = ['trainer_id', 'path'];

    public function trainer(){
        return $this->belongsTo('App\User', 'trainer_id')->withTrashed();
    }
}
