<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
           'txtUser'=>'required',
           'txtPass'=>'required',
           'txtRePass'=>'required|same:txtPass',
           'txtEmail'=>'required|email',

        ];
    }

	public function messages(){
		return [
			'txtUser.required'=>'Username is required !!!',
			'txtPass.required'=>'Password is required !!!',
			'txtRePass.required'=>'RePassword is required !!!',
			'txtRePass.same'=>'RePassword and Password are not match !!!',
			'txtEmail.required'=>'Email is required !!!',
			'txtEmail.email'=>'This email is irregular !!!',
		];
	}
}
