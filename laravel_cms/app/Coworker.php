<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coworker extends Model
{
    public function page()
    {
        return $this->belongsTo('App\Page', 'page_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }


}
