<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feedback;
use Carbon\Carbon;
use Auth;

class FeedbackController extends Controller
{
    //
    public function saveFeedback(Request $request){
    	$store = new Feedback;
    	$store->ques_id = $request->id;
    	$store->email = Auth::user()->email;
    	$store->amount = $request->bid;
    	$store->at = Carbon::now();
    	$store->save();
    }

    public function show(){
    	$buy_data = Feedback::where('ques_id', 'buy')->get();

    	$buy = Feedback::where('ques_id', 'buy')->max('amount');

    	$buy_avg = Feedback::where('ques_id', 'buy')->avg('amount');

    	$buy_email = Feedback::where('ques_id', 'buy')->where('amount', $buy)->get();


    	$subscribe_data = Feedback::where('ques_id', 'subscribe')->get();

    	$subscribe = Feedback::where('ques_id', 'subscribe')->max('amount');

    	$subscribe_email = Feedback::where('ques_id', 'subscribe')->where('amount', $subscribe)->get();

    	$subscribe_avg = Feedback::where('ques_id', 'subscribe')->avg('amount');


    	return view('pages.feedback', compact('buy_data', 'buy', 'buy_email', 'buy_avg', 'subscribe', 'subscribe_data', 'subscribe_email', 'subscribe_avg'));
    }
}
