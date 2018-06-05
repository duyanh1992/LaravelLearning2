<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateRequest extends FormRequest
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
            'txtCateName' => 'required|unique:cates,name'
            // 'txtOrder' => 'required',
            // 'txtKeywords' => 'required',
            // 'txtDescription' => 'required'
        ];
    }

	public function messages(){
		return [
			'txtCateName.required' => 'Category name is required !!!',
			'txtCateName.unique' => 'Category name is existed !!!'
            // 'txtOrder.required' => 'Order name is required !!!',
            // 'txtKeywords.required' => 'Keywords is required !!!',
            // 'txtDescription.required' => 'Description is required !!!'
		];
	}
}
