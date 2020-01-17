<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function blog()
    {
        return $this->hasMany('App\Blog');
    }
}
