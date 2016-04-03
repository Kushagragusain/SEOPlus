<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SearchedUrl extends Model
{
    //
    protected $fillable = [

    ];

    public function scopeFetchId($query, $url){
         return $query->latest('searched_at')->where('user_id', Auth::user()->id)->where('url', $url)->first();
     }
}
