<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

	public function __construct(){
		$this->middleware('guest:admin')->expect('logout');
	}

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:8',
    	]);
    	if (Auth::guard('admin')->attempt(['email'=>$request-email,'password'=>$request->password])) {
    		return redirect()->intended(route('admin.dashboard'));
    	}
    }
}
