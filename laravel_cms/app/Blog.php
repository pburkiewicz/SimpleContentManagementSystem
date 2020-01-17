<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    public function page()
    {
        return $this->belongsTo('App\Page', 'page_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
