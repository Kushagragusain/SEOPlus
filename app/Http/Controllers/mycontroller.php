<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Requests\ValidateUserRequest;
use App\Http\Controllers\Controller;

class mycontroller extends Controller
{
    
	//to log in a user
    public function check()
    {	
    	if(isset($_POST['user_name']) && isset($_POST['password']))
    	{
	    	$username = $_POST['user_name'];
	    	$password = $_POST['password'];
	    	if($username == '' || $password == '')
	    	{	$error = 'both the fields should not be empty';
	    		return view('fail',compact('error'));
	    	}
	    	else
	    	{
	    		$results = DB::select('select * from test');
	    		foreach ($results as $res) {
		    		$un=$res->user_name;
		    		$pass = $res->password;
		    		if($username == $un && $password == $pass)
			    		return "ghfvh";
				}
				$error = 'username or password is wrong !!';
			    return view('fail',compact('error'));
	    	}
    	}
    	else
    		return view('welcome');
    }

    //save data of new user
    public function save(ValidateUserRequest $request)
    {	
    		$input = $request->all();
            DB::insert('insert into test (user_name, email, password) values (?, ?, ?)', [$input['user_name'], $input['mail'], $input['password']]);
            //test::create($input);
            return view('welcome');
    }

    public function signup()
    {	
    	return view('signup');
    }
}
