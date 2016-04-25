<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Billable;
use DB;
use Auth;
use App\SearchedKeyword;
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

             {  $sq =10;

                $var = SearchedKeyword::where('user_id',Auth::user()->id)->get();

                if( DB::table('subscriptions')->where('user_id',Auth::user()->id)->count() > 1)

{           $sq = $sq +10;
           DB::table('users') ->where('id', Auth::user()->id)->update(array('url_count' => 0));

}

              if(Auth::user()->url_count <=2 && count($var)<=$sq)
                    return $next($request);
                else
              return redirect('payerror');


            }
             return redirect('new');


    }
}
