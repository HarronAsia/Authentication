<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'sub_title','sub_detail','sub_photo','event_id',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class,'event_contents');
    }

}
