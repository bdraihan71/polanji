<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends PolanjiModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
