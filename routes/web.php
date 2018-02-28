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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'test'], function(){
	Route::get('testLayout', function(){
		return view('admin.user.edit');
	});
});

route::get('midError', function(){
	return 'NO';
})->name('midError');

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
