<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function page()
    {
        return $this->belongsTo('App\Page', 'page_id', 'id');
    }
}
