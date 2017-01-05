<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','option_a','option_b','option_c','option_d','correct','num'];

}
