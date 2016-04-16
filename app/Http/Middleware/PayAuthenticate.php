<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Billable;
use DB;
use Auth;
use App\SearchedKeyword;

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


            $var = SearchedKeyword::where('user_id',Auth::user()->id)->get();
            if(Auth::user()->url_count <=2 )
                return $next($request);

        }

        return redirect('new');
    }
}
