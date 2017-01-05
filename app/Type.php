<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function courses(){
        return $this->hasMany('App\Course');
    }
    public function information(){
        return $this->hasMany('App\Information');
    }
}
