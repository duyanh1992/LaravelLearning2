<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:users,username|min:6',
			'password'=>'required|min:4',
			'c_password'=>'required|same:password',
			'email'=>'required|email|unique:users,email',
        ];
    }
	
	public function messages()
    {
        return [
            'name.required'=>'Username is required !!!',
            'name.unique'=>'This username is existed !!!',
			'password.required'=>'Password is required !!!',
			'c_password.required'=>'Confirm Password is required !!!',
			'c_password.same'=>'Password and Confirm Password are not match !!!',
			'email.required'=>'Email is required !!!',
			'email.email'=>'Please enter a valid email !!!',
			'email.unique'=>'This email is existed !!!'
        ];
    }
}
