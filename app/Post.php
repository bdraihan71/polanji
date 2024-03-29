<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends PolanjiModel
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function replys()
    {
        return $this->hasMany('App\Reply');
    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
{
    return $this->belongsToMany('App\Tag');
}
}
