<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name','type_id'
    ];
    public function admin(){    //函数名要跟模型名相同
        return $this->belongsTo('App\Admin');
    }
    public function video(){
        return $this->hasMany('App\Video');
    }
    public function textbooks(){
        return $this->hasMany('App\Textbook');
    }
    public function exam(){
        return $this->hasOne('App\Exam');
    }
    public function type(){
        return $this->belongsTo('App\Type');
    }
    public function questions() {
        return $this->hasManyThrough('App\Question', 'App\Exam');
    }
}
