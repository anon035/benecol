<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'event_type', 'trainer_id', 'player_id', 'category_id', 'event_date', 'is_present'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function trainer() {
        return $this->belongsTo('App\User', 'trainer_id');
    }

    public function player() {
        return $this->belongsTo('App\User', 'player_id')->withTrashed();
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
