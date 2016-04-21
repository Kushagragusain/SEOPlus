<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    public function sendEmailReminder(Request $request, $id)

    {
            $user = User::findOrFail($id);

            Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {

            $m->from('seoplus.prashushi.com', 'Application');

            $m->to($user->email, $user->name)->subject('verify mail');

        });
    }
}
