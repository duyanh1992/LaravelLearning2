<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });


Route::group(['prefix'=>'test'], function(){
	Route::get('testLayout', function(){
		return view('user.pages.product');
	});
});

route::get('midError', function(){
	return 'NO';
})->name('midError');

// home page:
Route::get('/', ['as'=>'home', 'uses'=>'HomeController@getHomePage']);

Route::group(['prefix'=>'admin'], function(){
	//Route::group(['prefix'=>'login'], function(){
		Route::get('getLogin', ['as'=>'getLogin', 'uses'=>'LoginController@getLogin']);
		Route::post('postLogin', ['as'=>'postLogin', 'uses'=>'LoginController@postLogin']);
		Route::get('getLogout', ['as'=>'getLogout', 'uses'=>'LoginController@getLogout']);
	//});

	Route::group(['prefix'=>'admin-content', 'middleware'=>'checkLogin'], function(){
		Route::group(['prefix'=>'cate'], function(){
			Route::get('getAddCate', ['as'=>'getAddCate', 'uses'=>'CateController@getAdd']);
			Route::post('postAddCate', ['as'=>'postAddCate', 'uses'=>'CateController@postAdd']);
			Route::get('getListCate', ['as'=>'getListCate', 'uses'=>'CateController@getListCate']);
			Route::get('getDelCate/{cate_id}', ['as'=>'getDelCate', 'uses'=>'CateController@getDelCate']);
			Route::get('getEditCate/{cate_id}', ['as'=>'getEditCate', 'uses'=>'CateController@getEditCate']);
			Route::post('postEditCate/{cate_id}', ['as'=>'postEditCate', 'uses'=>'CateController@postEditCate']);
		});

		Route::group(['prefix'=>'product'], function(){
			Route::get('getAddPrd', ['as'=>'getAddPrd', 'uses'=>'ProductController@getAddPrd']);
			Route::post('postAddPrd', ['as'=>'postAddPrd', 'uses'=>'ProductController@postAddPrd']);
			Route::get('getListPrd', ['as'=>'getListPrd', 'uses'=>'ProductController@getListPrd']);
			Route::get('getDelPrd/{prd_id}', ['as'=>'getDelPrd', 'uses'=>'ProductController@getDelPrd']);
			Route::get('getEditPrd/{id}', ['as'=>'getEditPrd', 'uses'=>'ProductController@getEditPrd']);
			Route::post('postEditPrd/{prd_id}/{user_id}', ['as'=>'postEditPrd', 'uses'=>'ProductController@postEditPrd']);
			Route::get('delDetailImg/{img_id}', ['as'=>'delDetailImg', 'uses'=>'EditProductController@delDetailImg']);
		});

		Route::group(['prefix'=>'user'], function(){
			Route::get('getAddUser', ['as'=>'getAddUser', 'uses'=>'UserController@getAddUser']);
			Route::post('postAddUser', ['as'=>'postAddUser', 'uses'=>'UserController@postAddUser']);
			Route::get('getListUser', ['as'=>'getListUser', 'uses'=>'UserController@getListUser']);
			Route::get('getDelUser/{id}', ['as'=>'getDelUser', 'uses'=>'UserController@getDelUser']);
			Route::get('getEditUser/{id}', ['as'=>'getEditUser', 'uses'=>'UserController@getEditUser']);
			Route::post('postEditUser/{id}', ['as'=>'postEditUser', 'uses'=>'UserController@postEditUser']);
		});
	});

});

Route::group(['prefix'=>'homesite'], function(){
	Route::get('getPrdCate/{cate_id}', ['as'=>'getPrdCate', 'uses'=>'HomeController@getPrdCate']);

	// Get all product by cate id:
	Route::get('getAllPrdByCate/{cate_id}', ['as'=>'getAllPrdByCate', 'uses'=>'HomeController@getAllPrdByCate']);

	// Detail product:
	Route::get('getDetailPrd/{prd_id}/{cate_id}', ['as'=>'getDetailPrd', 'uses'=>'HomeController@getDetailPrd']);
	Route::get('getMail', ['as'=>'getMail', 'uses'=>'HomeController@getMail']);
	Route::post('postMail', ['as'=>'postMail', 'uses'=>'HomeController@postMail']);


	Route::group(['prefix'=>'shoppingCart'], function(){
		// Add cart:
		Route::get('addCart/{prd_id}/{user_id}', ['as'=>'addCart', 'uses'=>'HomeController@addCart']);

		// Cart info:
		Route::get('getCartInfo/{user_id}', ['as'=>'getCartInfo', 'uses'=>'HomeController@getCartInfo']);

		// del cart:
		Route::get('getDelCart/{id}/{user_id}', ['as'=>'getDelCart', 'uses'=>'HomeController@getDelCart']);

		// edit cart
		Route::get('getEditCart', ['as'=>'getEditCart', 'uses'=>'EditCartController@getEditCart']);
	});

	// Get login:
	Route::get('getUserLogin', ['as'=>'getUserLogin', 'uses'=>'HomeController@getUserLogin']);

	// Post login:
	Route::post('postUserLogin', ['as'=>'postUserLogin', 'uses'=>'HomeController@postUserLogin']);

	// log out
	Route::get('logout', ['as'=>'logout', 'uses'=>'HomeController@logout']);
	Route::get('socialLogout', ['as'=>'socialLogout', 'uses'=>'HomeController@socialLogout']);

	//get sign up:
	Route::get('getSignup', ['as'=>'getSignup', 'uses'=>'HomeController@getSignup']);

	// post sign up
	Route::post('postSignup', ['as'=>'postSignup', 'uses'=>'HomeController@postSignup']);

	// google login:
	Route::get('login/google', 'HomeController@googleRedirectToProvider');
	Route::get('login/google/callback', 'HomeController@googleHandleProviderCallback');

	// facebook login:
	Route::get('login/facebook', 'HomeController@facebookRedirectToProvider');
	Route::get('login/facebook/callback', 'HomeController@facebookHandleProviderCallback');


	// Get search text
	Route::post('search', ['as'=>'search', 'uses'=>'HomeController@searchPrd']);

	// Get product by search str
	Route::get('search/{text}', ['as'=>'getSearch', 'uses'=>'HomeController@getSearch']);

	// Route::post('filterPrd', ['as'=>'filterPrd', 'uses'=>'HomeController2@filterPrd'] );
});
