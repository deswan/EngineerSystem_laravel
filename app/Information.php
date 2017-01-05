<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['title','text','category_id','type_id'];
    public function admin(){
        return $this->belongsTo('App\Admin');
    }
    public function type(){
        return $this->belongsTo('App\Type');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
