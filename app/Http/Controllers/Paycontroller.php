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

        $user->newSubscription('monthly', 'monthly')->trialDays(30)->create($token);

        return view('pages.dashboard');

    }
//we need a cancel button above logout ..
    public function cancel(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->subscription('monthly')->cancel();
    }


    public function confirmEmail($email_token)
    {
        $user = User::where('email_token', $email_token)->first();
        $user->confirmEmail();
        flash('you are now confirmed');

        return redirect('login');

    }
}
