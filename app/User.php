<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'registration_number', 'phone_number', 'dress_number', 'has_suit', 'user_type', 'birth_date', 'category_id', 'parking_card', 'responsibility', 'licence', 'certificate', 'clubs', 'title_before', 'title_after'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->forceDeleting) {
                $user->photo()->delete();
                $user->membership()->delete();
                foreach ($user->playerAttendance as $attendance) {
                    $attendance->delete();
                }
                foreach ($user->eventParticipants as $participant) {
                    $participant->delete();
                }
            }
        });
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime(preg_replace('/\s/', '', $value)));
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function photo()
    {
        return $this->hasOne('App\TrainerPhoto', 'trainer_id');
    }

    public function membership()
    {
        return $this->hasOne('App\Membership', 'player_id');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function eventParticipants()
    {
        return $this->hasMany('App\EventParticipant', 'player_id');
    }

    public function playerAttendance()
    {
        return $this->hasMany('App\Attendance', 'player_id');
    }

    public function trainerAttendance()
    {
        return $this->hasMany('App\Attendance', 'trainer_id');
    }
}
