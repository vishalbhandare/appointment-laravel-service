<?php

namespace App\User\Model;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['name', 'duration_min', 'user_id'];
    public function event()
    {
        return $this->hasMany('App\User\Model\Event');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }

}
