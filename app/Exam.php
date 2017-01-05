<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name','course_id'];
    public function question(){
        return $this->hasMany('App\Question');
    }
}
