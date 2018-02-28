<?php

namespace App\Http\Controllers;

use Request;
use App\Product;
use App\Cate;
use App\ProductImages;
use File;

class EditProductController extends Controller
{
	public function delDetailImg($imd_id){
		if(Request::ajax()){
			//Get ajax data:
			$imgId = Request::get('imgId');
			$urlImg = Request::get('urlImg');
			
			//Get img data:
			$imgData = ProductImages::find($imgId);
			$imgUrl = 'image/'.$imgData->image;
			if(!empty($imgData)){
				if(File::exists($imgUrl)){
					File::delete($imgUrl);
				}
				$imgData->delete();
			}
			return 'ok';
		}
	}
}
