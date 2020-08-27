<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'player_id', 'amount', 'note', 'total'
    ];

    public function player() {
        return $this->belongsTo('App\User')->withTrashed();
    }
}
