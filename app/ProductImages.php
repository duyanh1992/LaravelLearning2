<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
	
	public function relateToProduct(){
		return $this->belongsTo('App\Product', 'product_id');
	}
}
