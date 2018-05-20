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
			//Create login data
		$loginData = array('username'=>$name, 'password'=>$pass, 'level'=>1);
		if(Auth::attempt($loginData)){		// If login data is correct -> user could go into admin portal (attach message)
			$_SESSION['user_data'] = $loginData;
			return redirect('admin/admin-content/user/getListUser')->with(['type'=>'success', 'message'=>'Logging in successful !!!']);
		}
		else{		// If login data is incorrect -> move user back to login page (attach message)
			return redirect()->back()->with(['type'=>'danger', 'message'=>'User name or password is not correct !!!']);

		}
	}

	public function getLogout(){
		session_destroy();
		return redirect()->route('getLogin');
	}
}
