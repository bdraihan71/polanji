<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends PolanjiModel
{
    public function posts()
{
    return $this->belongsToMany('App\Post');
}
}
