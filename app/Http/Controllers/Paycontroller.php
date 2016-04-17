<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Billable;

use App\User;

use Auth;
use App\SearchedKeyword;

use DB;

class Paycontroller extends Controller
{
    public function check(Request $request)
    {

        $token = request('stripeToken');

        $user = User::find(Auth::user()->id);

        $user->newSubscription('monthly', 'monthly')->trialDays(1)->create($token);

        return view('pages.dashboard');

    }


}
