<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;



class AdminLoginController extends Controller
{


    protected $redirectTo = '/admin/dashboard';

    public function __construct(){
      $this->middleware('guest:admin', ['except' => ['logout']]);
  }


  public function showLoginForm(){
     return view('auth.admin-login');
 }

 public function login(Request $request){
     
    	//Validate the form data
     $this->validate($request, [
      'email' 		=> 'email|required',
      'password' 		=> 'required|min:6'
      ]);

    	//Attempt to log the user in
     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		//If successful then redirect to the intended location
      return redirect()->intended(route('admin.dashboard'));
      
  }

    	//If unsuccessfull, then redirect to the admin login with the data
  Session::flash('errors', "Username and password combination doesn't match");
  return redirect()->back()->withInput($request->only('email', 'remember'));
}


public function logout()
{
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
}
}
