<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'movie_genres');
    }
}
