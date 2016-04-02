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

    //to remove added keywords after logout
    public function scopeStatus($query){
         return $query->where('user_id', Auth::user()->id)->update(['status'=>'old']);
     }

    //to fetch keywords of current session of user
    public function scopeActiveKeywords($query, $url){
         return $query->where( 'user_id', Auth::user()->id )->where('status', 'active')->where('url', $url)->get();
     }

    //to check existance of a keyword for a user
    public function scopeCheckKeyword($query, $url, $keyword){
         return $query->where( 'user_id', Auth::user()->id )->where('url', $url)->where('keyword', $keyword)->get();
     }

    //to check existance of a keyword for a user
    public function scopeCheckKeywordTable($query, $url, $keyword){
         return $query->where( 'user_id', Auth::user()->id )->where('url', $url)->where('keyword', $keyword)->where('status', 'active')->get();
     }

    //change status to active from old
    public function scopeStatusToActive($query, $url, $keyword){
         return $query->where( 'user_id', Auth::user()->id )->where('url', $url)->where('keyword', $keyword)->update(['status'=>'active']);
     }
}
