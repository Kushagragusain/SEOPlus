<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Billable;
use DB;
use Auth;
use App\SearchedKeyword;
use App\SearchedUrl;
use Session;

class PayAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user= $request->user();

            if( $user->isSubscribed())
             {

                $keywordallowed= 10;
                $urlallowed= 2;

                $nok = SearchedKeyword::where('user_id',Auth::user()->id)->get();

                $nou = SearchedUrl::where('user_id',Auth::user()->id)->groupBy('url_id')->get();

                $subcount = DB::table('subscriptions')->where('user_id',Auth::user()->id)->count();

                $ok = 1;

                if(count($nou) == $urlallowed * $subcount) {
                //If the latest entry is old
                    $check = SearchedUrl::where('user_id',Auth::user()->id)
                        ->where('url', $request->url)->get();
                    if(count($check) === 0)
                        $ok = 0;
                }


              if( count($nou) <= $urlallowed * $subcount && count($nok) < $keywordallowed * $subcount && $ok == 1)
                    return $next($request);
              else
                  return redirect('payerror');

            }

             return redirect('new');
    }
}
