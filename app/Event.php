<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','detail', 'thumbnail','user_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'user_events');
    }


}
