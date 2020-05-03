<?php

namespace App\User\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'scheduled_at', 'user_id', 'event_type_id'];

    public function eventype()
    {
        return $this->belongsTo('App\User\Model\EventType','event_type_id', 'id');
    }

}
