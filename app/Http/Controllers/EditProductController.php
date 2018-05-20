<?php

namespace App\Http\Controllers;

use Request;
use App\Product;
use App\Cate;
use App\ProductImages;
use File;

class EditProductController extends Controller
{
	public function delDetailImg($img_id){
		if(Request::ajax()){   // If request is ajax
			//Get ajax data:
				// Get image id
			$imgId = Request::get('imgId');

			// Get image url:
			//$urlImg = Request::get('urlImg');

			//Get img data:
			$imgData = ProductImages::find($imgId);

			// Set image url:
			$imgUrl = 'image/'.$imgData->image;

			if(!empty($imgData)){   // If there's image data...
				if(File::exists($imgUrl)){   // If this image is existed
					File::delete($imgUrl);		// Delete this image
				}
				$imgData->delete();					//Delete this image data in DB
			}
			return 'ok';									// If everything is ok
		}
	return false;											// If there's a problem
	}
}
