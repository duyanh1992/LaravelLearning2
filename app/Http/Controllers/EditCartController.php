<?php

namespace App\Http\Controllers;

use Request;
use Cart;

class EditCartController extends Controller
{
    public function getEditCart(){
		if(Request::ajax()){	//If request is ajax 
			//Get request data:
			$tokenForm = Request::get('tokenForm');
			$rowId= Request::get('rowId');
			$qty = Request::get('qty');

			//$arr = array($tokenForm, $rowId, $qty);

			//Update cart:
			Cart::update($rowId, $qty);	
			return 'ok';
		}
	}
}
