<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\EditUserRequest;
use Hash;

class UserController extends Controller
{
    public function getAddUser(){
		return view('admin.user.add');
	}
	
	public function postAddUser(Request $request){
		// Validate form:
		 $this->validate($request,
		 [
			'txtUser'=>'required|unique:users,username',
			'txtPass'=>'required',
			'txtRePass'=>'required|same:txtPass',
			'txtEmail'=>'required|email'
		 ], 
		 [
			'txtUser.required'=>'User is required !!!',
			'txtUser.unique'=>'User is existed !!!',
			'txtPass.required'=>'Password is required !!!',
			'txtRePass.required'=>'RePassword is required !!!',
			'txtRePass.same'=>'RePassword and Password are not match !!!',
			'txtEmail.required'=>'Email is required !!!',
			'txtEmail.email'=>'Email is irregular  !!!',
			
		 ]
		 );
		 
		// Start adding member into DB:
		$user = new User();
		$user->username = $request->txtUser;
		$user->email = $request->txtEmail;
		$user->password = Hash::make($request->txtPass);
		$user->level = $request->rdoLevel;
		$user->remember_token = $request->_token;
		if($user->save()){
			return redirect('admin/user/getListUser')->with(['type'=>'success', 'message'=>'Adding user successful']);
		}
		else{
			return redirect('admin/user/getAddUser')->with(['type'=>'success', 'message'=>'Error']);			
		}
	}
	
	public function getListUser(){
		$allUser = User::select('id', 'username', 'level')->get();
		return view('admin.user.list', compact('allUser'));
	}
	
	public function getDelUser($user_id){
		$user = User::find($user_id);
		// echo "<pre>";
		// echo($user->level);
		// echo "</pre>";
		if(($user->level) != 1){
			$user->delete($user_id);
			return redirect()->route('getListUser')->with(['type'=>'success', 'message'=>'Deleting user successful']);
		}
		else{
			return redirect()->route('getListUser')->with(['type'=>'danger', 'message'=>'You do not have enough permission to delete this admin']);			
		}
	}
	
	public function getEditUser($user_id){
		$user = User::find($user_id);
		return view('admin.user.edit',compact('user'));
	}
	
	public function postEditUser(EditUserRequest $request, $user_id){
		//Start editing user:
		$user = User::find($user_id);
		if($user['level'] != 1){
			$current_user = User::select('id')->where('username', $user['username'])
								  ->first();
			if((!empty($current_user)) && ($current_user->id) == $user['id']){
				$user->username = $request->txtUser;
				$user->password = $request->txtPass;
				$user->email = $request->txtEmail;
				$user->level = $request->rdoLevel;
				if($user->save()){
					return redirect()->route('getListUser')->with(['type'=>'success', 'message'=>'Editing user successful']);			
				}
				else{
					return redirect()->route('getListUser')->with(['type'=>'danger', 'message'=>'There was an error']);			
				}
			}					  
			else{
				return redirect()->route('getListUser')->with(['type'=>'alert', 'message'=>'This user is existed !!!']);			
			}	
		}
		
		else{
			return redirect()->route('getListUser')->with(['type'=>'danger', 'message'=>'You do not have enough permission to edit this admin']);			
		}
	}
}
