<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
class Content extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id','id');
    }
}
