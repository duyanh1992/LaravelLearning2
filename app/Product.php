<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	
	public function relateToCate(){
		return $this->belongsTo('App\Cate', 'cate_id');
	}
	
	public function relateToImage(){
		return $this->hasMany('App\ProductImages');
	}
	
	public function relateToUser(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
