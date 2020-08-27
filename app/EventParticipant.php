<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $fillable = [
        'player_id', 'event_id', 'is_present', 'user_submitted'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function player() {
        return $this->belongsTo('App\User')->withTrashed();
    }
}
