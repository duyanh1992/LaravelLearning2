<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Mail;
use Cart;
use App\User;
use Hash;
use Validator;
use Socialite;

if(!isset($_SESSION)){
	session_start();
}


class HomeController extends Controller
{
    public function getHomePage(){
    	// Get featured products:
		$featuredPrd = DB::table('products')
							->select('id', 'name', 'price', 'image', 'cate_id')
							->skip(0)->take(4)
							->get();

		//Get latest products:
		$latestPrd = DB::table('products')
							->select('id', 'name', 'price', 'image', 'cate_id')
							->skip(0)->take(4)
							->orderBy('id', 'DESC')
							->get();

		return view('user.pages.home', compact('featuredPrd','latestPrd'));
	}

	public function getPrdCate($cate_id){
		// Get all product by cate id:
		$prdCate = DB::table('products')->select('id', 'name', 'image', 'price', 'cate_id')
										->where('cate_id',$cate_id)
										->paginate(2);

		// Get parent cate id by cate id:
		$parentCate = DB::table('cates')->select('parent_id')
										->where('id', $cate_id)
										->first();

		// Get all child cate id by parent_id:
		$childCate = DB::table('cates')->select('name', 'id')
									   ->where('parent_id', $parentCate->parent_id)
									   ->get();

	   	// Get latest product ny cate id:
		$latestPrd = DB::table('products')
							->select('id', 'name', 'price', 'image', 'cate_id')
							->where('cate_id', $cate_id)
							->skip(0)->take(4)
							->orderBy('id', 'DESC')
							->get();

		// Get cate name
		$cateName = DB::table('cates')->select('name')
									  ->where('id', $cate_id)
									  ->first();

		return view('user.pages.category', compact('prdCate', 'childCate', 'latestPrd', 'cateName'));
	}

	public function getAllPrdByCate($cate_id){
		// Get child cate
		$childCates = DB::table('cates')->select('id')
									   ->where('parent_id', $cate_id)
									   ->get();

		// get child cate id list:							   
		foreach($childCates as $child_cate){
			$childCateId[] =  $child_cate->id;
		}

		// get all product by child cate id					
		$prdCate = DB::table('products')->select('id', 'name', 'price', 'image', 'cate_id')
									->whereIn('cate_id', $childCateId)
									->orderBy('name')
						     		->paginate(6);

		// $parentCate = DB::table('cates')->select('parent_id')
										// ->where('id', $cate_id)
										// ->first();

		// Get child cate by id:				      
		$childCate = DB::table('cates')->select('name', 'id')
									   ->where('parent_id', $cate_id)
									   ->get();

		// Get latest product by child cate id: 	   
		$latestPrd = DB::table('products')
							->select('id', 'name', 'price', 'image', 'cate_id')
							->whereIn('cate_id', $childCateId)
							->skip(0)->take(4)
							->orderBy('id', 'DESC')
							->get();

		// Get cate name:					
		$cateName = DB::table('cates')->select('name')
									  ->where('id', $cate_id)
									  ->first();

		return view('user.pages.category', compact('prdCate', 'childCate', 'latestPrd', 'cateName', 'cate_id'));

	}

	public function getDetailPrd($prd_id, $cate_id){
		// Get product info:
		$prd = DB::table('products')->select('id', 'name', 'price', 'image', 'cate_id')
									 ->where('id', $prd_id)
						             ->first();

        // Get detail image product: 
		$prdDetailImg = DB::table('product_images')->select('image')
												   ->where('product_id', $prd_id)
												   ->get();

		//Get related product:	   	
		$relatedPrd = DB::table('products')->select('id','name', 'price','image')
										   ->where('cate_id', $cate_id)
										   ->where('id', '<>', $prd_id)
										   ->skip(0)->take(4)
										   ->get();

		return view('user.pages.product', compact('prd', 'prdDetailImg', 'relatedPrd'));
	}

	public function getMail(){
		return view('user.pages.contact');
	}

	public function postMail(Request $request){
		$name = $request->name;
		$email = $request->email;
		$msg = $request->message;

		$data = ['name'=>$name, 'msg'=>$msg];
		Mail::send('user.mail.mail', $data, function($message) use($email){
			$message->from($email, 'Client');
			$message->to('alyssachia1992@gmail.com', 'Server')->subject('Test Laravel Mail');
		});
	}

	public function addCart($prd_id, $user_id){
		// Get product info
		$prd = DB::table('products')->select('id', 'name', 'price', 'image')
									->where('id', $prd_id)
									->first();

		// Add product to cart:
		Cart::add(['id'=>$prd_id, 'name'=>$prd->name, 'qty'=>1, 'price'=>$prd->price, 'options'=>['img'=>$prd->image, 'user_id'=> $user_id]]);

		return redirect()->route('getCartInfo',  $user_id);
	}

	public function getCartInfo($user_id){
		// Get current cart info:
		$cartContent = Cart::content();
		
		// Get each product in cart:
		foreach($cartContent as $val){
			if(isset($val->options['user_id']) && ($val->options['user_id'] == $user_id)){
				$prd_list[] = $val;
			}
		}

		// Get 
		$totalCart = Cart::total();
		
		return view('user.pages.shopping-cart', compact('prd_list', 'totalCart'));
	}

	public function getDelCart($id, $user_id){
		// Del product from Cart by ID:
		Cart::remove($id);
		return redirect()->route('getCartInfo', $user_id);
	}

	public function getUserLogin(){
		return view('user.pages.login');
	}

	public function getSignup(){
		return view('user.pages.register');
	}

	public function postSignup(SignupRequest $request){
		// Add new member:
		$user = new User();
		$user->username = $request->name;
		$user->password = Hash::make($request->password);
		$user->email = $request->email;
		$user->level = 2;
		$user->remember_token = ($request->_token).Hash::make($request->password);

		if($user->save()){
			return redirect()->route('getSignup')->with(['type'=>'success', 'message'=>'Signing up successfully. Please sign in !!!']);
		}
		else{
			return redirect()->route('getSignup')->with(['type'=>'danger', 'message'=>'There was an error. Please try again later !!!']);
		}
	}

	public function postUserLogin(Request $request){
		$v = Validator::make($request->all(),[
			'email'=>'required|email',
			'password'=>'required'
		],
		[

			'password.required'=>'Password is required !!!',
			'email.required'=>'Email is required !!!',
			'email.email'=>'Please enter a valid email !!!'
		]);

		// If there are validation errors, move user back to login page and attach errors message:
		$errors = $v->errors();
		
		if(count($errors) > 0){
			return redirect()->route('getUserLogin')->with(compact('errors'));
		}

		// Signing user in: (If there's no validation error)
		$email = $request->email;
		$password = $request->password;
		$arr_user = array('email'=>$email, 'password'=>$password);

		if(Auth::attempt($arr_user)){		// Use Auth to log user in:
			return redirect()->route('home');
		}
		else{
			return redirect()->route('getUserLogin')->with(['type'=>'danger', 'message'=>'There was an error. Please try again later !!!']);
		}
	}

	public function searchPrd(Request $request){
		$rules = array(
					'sText'=>'required'
				);
		$messages = array(
						'sText.required'=>'Please enter something !!!'
					);

		$v = Validator::make($request->all(), $rules, $messages);
		$errors = $v->errors();
		if(count($errors) > 0){
			return redirect()->route('home')->with(compact('errors'));
		}

		// Get search text
		$sText =  trim($request->sText);

		//Split stext, put them in an array;
		$arr_stext = explode(' ', $sText);

		// Unset null element:
		$arr_stext =  array_filter($arr_stext);

		// Join them into new str:
		$str_text = implode(',', $arr_stext);

		return redirect()->route('getSearch',$str_text);
	}

	public function getSearch($text){
		$text = '%'.$text.'%';
		// Execute sql :
		$prd = DB::table('products')->select('id', 'name', 'price', 'cate_id', 'image')
									->where('name', 'like', $text)
									->paginate(3);
		return view('user.pages.search_list')->with(compact('prd'));
	}

	public function logout(){
		if(Auth::check()){		// If user is logging in
			Auth::logout();		// Log user out
		}
		return redirect()->route('home');
	}

	public function socialLogout(){
		session_destroy();
		return redirect()->route('home');
	}

	public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->scopes(['profile','email'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleHandleProviderCallback()
    {
		// Get user info from google:
        $user = Socialite::driver('google')->stateless()->user();

		// echo "<pre>";
        // print_r($user);
		// echo "</pre>";

		$name = $user->name;
		$email = $user->email;
		$password = $user->id;
		$token = $user->token;

		// Check if there's an user email in DB?
		$checkUser = User::select('id')->where('email', $email)->first();

		// If not, add user into DB:
		if(count($checkUser) <= 0){
			$addUser = new User();
			$addUser->username = $name;
			$addUser->email = $email;
			$addUser->password = $password;
			$addUser->level = 2;
			$addUser->remember_token = substr($token, 0, 10);
			if($addUser->save()){	// If adding user is ok, save user name and user is into session : 
				$_SESSION['social_name'] = $name;
				$_SESSION['social_id'] = $addUser->id;
				return redirect()->route('home');
			}
		}
		else{ // If yes, save user name and user is into session :
			$_SESSION['social_name'] = $name;
			$_SESSION['social_id'] = $checkUser->id;
			return redirect()->route('home');
		}
	}

	public function facebookRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebookHandleProviderCallback()
    {
    	// Get user info from facebook:
        $user = Socialite::driver('facebook')->user();

		$name = $user->name;
		$email = $user->email;
		$password = $user->id;
		$token = $user->token;

		// Check if there's an user email in DB?

		$checkUser = User::select('id')->where('email', $email)->first();

		if(count($checkUser) <= 0){   // If not, add user into DB:
			$addUser = new User();
			$addUser->username = $name;
			$addUser->email = $email;
			$addUser->password = $password;
			$addUser->level = 2;
			$addUser->remember_token = substr($token, 0, 10);
			if($addUser->save()){   // If adding user is ok, save user name 
				$_SESSION['social_name'] = $name;
				$_SESSION['social_id'] = $addUser->id;
				return redirect()->route('home');
			}
		}
		else{ // If yes, save user name and user is into session :

			$_SESSION['social_name'] = $name;
			$_SESSION['social_id'] = $checkUser->id;
			return redirect()->route('home');
		}
    }
}
