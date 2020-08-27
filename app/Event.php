<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_date', 'event_type', 'category_id', 'user_id', 'note'
    ];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function participants()
    {
        return $this->hasMany('App\EventParticipant');
    }

    public function setEventDateAttribute($value)
    {
        $value = explode('|', $value);
        $value[0] = date('Y-m-d', strtotime(preg_replace('/\s/', '', $value[0])));
        $date = date('Y-m-d H:i:s', strtotime(implode(' ', $value)));
        $this->attributes['event_date'] = $date;
    }
}
