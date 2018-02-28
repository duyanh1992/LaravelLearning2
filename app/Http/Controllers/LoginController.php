<?php
namespace App\Http\Controllers;

if (!isset($_SESSION)) {
	session_start();
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin(){
		return view('admin.login');
	}
	
	public function postLogin(Request $request){
		// Validate form:
		$this->validate($request,
			[
				'username'=>'required',
				'password'=>'required'
			],
			
			[
				'username.required'=>'Username is required !!!',
				'password.required'=>'Password is required !!!'
			]
		);
		
		// Start logging in:
		$name = $request->username;
		$pass = $request->password;
		$loginData = array('username'=>$name, 'password'=>$pass, 'level'=>1);
		if(Auth::attempt($loginData)){
			$_SESSION['user_data'] = $loginData;
			return redirect('admin/admin-content/user/getListUser')->with(['type'=>'success', 'message'=>'Logging in successful !!!']);
		}
		else{
			return redirect()->back()->with(['type'=>'success', 'message'=>'Logging in failed !!!']);

		}
	}
	
	public function getLogout(){
		session_destroy();
		return redirect()->route('getLogin');
	}
}
