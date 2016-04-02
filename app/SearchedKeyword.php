<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SearchedKeyword extends Model
{
    //to get id
     public function scopeId($query, $url, $keyword){
         return $query->latest('searched_at')->where('url', $url)->where('user_id', Auth::user()->id)->where('keyword', $keyword)->where('status', 'active')->take(1)->get();
     }
}
