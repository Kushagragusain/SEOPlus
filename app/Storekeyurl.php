<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storekeyurl extends Model
{
    //
    public $timestamps = false;

     protected $fillable = [
         'keywordname',
         'urls',
         'latestcheck',
    ];
}
