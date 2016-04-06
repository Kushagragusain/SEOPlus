<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \SEOstats\Services as SEOstats;
use App\SearchedUrl;
use App\SearchedKeyword;
use App\Keydata;
use App\Country;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

class SEOOController extends Controller
{

     public function fetchkeywords($id){
        $url = $id;
        $urlid = SearchedUrl::fetchId($url)['id'];
 SearchedKeyword::where('user_id', Auth::user()->id)->where('url', $url)->update(['url_id' => $urlid, 'status' => 'active']);

        $result = SearchedKeyword::activeKeywords($url);


         $data['data'] = [];
        $i = 0;
        for($i=0;$i<sizeof($result);$i++){

             $data['data'][$i]['id'] = $result[$i]->id;
             $data['data'][$i]['keyword'] = $result[$i]->keyword;
             $data['data'][$i]['status'] = $result[$i]->status;
        }
      return ($data);
    }

    }
