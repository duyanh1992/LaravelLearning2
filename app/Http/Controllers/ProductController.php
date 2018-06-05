<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cate;
use App\ProductImages;
use File;
use Auth;

class ProductController extends Controller
{
    public function getAddPrd(){
      // Get category cate:
		$getListCate = Cate::select('id','name','parent_id')
							         ->get()
                       ->toArray();
		return view('admin.product.add', compact('getListCate'));
	}

	public function postAddPrd(Request $request){
		//Validate form:
		$this->validate($request,
			[
				'sltPrd'=>'required',
				'txtName'=>'required|unique:products,name',
				'txtPrice'=>'required',
				'fImages'=>'required|image',
        'txtIntro'=>'nullable',
        'txtContent'=>'nullable',
        'txtKeywords'=>'nullable',
        'txtDescription'=>'nullable',
        'detailImages'=>'nullable'
			],
			[
				'sltPrd.required'=>'Product cate is required !!!',
				'txtName.required'=>'Product name is required !!!',
        'txtName.unique'=>'Product name is existed !!!',
				'sltPrd.unique'=>'This product name is existed !!!',
				'txtPrice.required'=>'Product price is required !!!',
				'fImages.required'=>'Product image is required !!!',
				'fImages.image'=>'The file upload is not image !!!'
			]
		);

		// Add product into DB:

		$arrEx = array('jpg', 'png');

			//Get file name:
		if($request->hasFile('fImages')){
			$file = $request->file('fImages');
			$fileName = $file->getClientOriginalName('fImages');
			$fileExtension = $file->getClientOriginalExtension('fImages');
		}

    // Add product into DB:
		$addPrd = new Product();
		$addPrd->name = $request->txtName;
		$addPrd->alias = $request->txtName;
		$addPrd->price = $request->txtPrice;
		$addPrd->intro = $request->txtIntro;
		$addPrd->content = $request->txtContent;
		$addPrd->image = $fileName;
		$addPrd->keywords = $request->txtKeywords;
		$addPrd->description = $request->txtDescription;
		$addPrd->user_id = Auth::user()->id;;
		$addPrd->cate_id = $request->sltPrd;
		if($addPrd->save()){
			$product_id = $addPrd->id;

			//upload file into img folder:
        // Check file extension:
			if(in_array($fileExtension, $arrEx)){
        // If ok, move file:
				$file->move('image', $fileName);
			}
			else{
        //If not, move user back to previous page (attach alert message)
				return redirect()->back()->with(['type'=>'danger', 'message'=>'File type is not valid']);
			}

			// Upload muiltiple images:
			if($request->hasFile('detailImages')){
				foreach($_FILES['detailImages']['name'] as $key=>$detailImage){
					//Upload images:
            // Get file info:
              // Get file name:
					$mFileName = $detailImage;
					//$mFileEx = $_FILES['detailImages']['type'][$key];
              // Get tmp name:
					$tmpName = $_FILES['detailImages']['tmp_name'][$key];
					$newPath = 'image/'.$mFileName;

              // Get file extension:
      		$arr = pathinfo($_FILES['detailImages']['name'][$key]);
      		$mFileEx =  $arr['extension'];

            // Check file type:
          if(in_array($mFileEx, $arrEx)){  // If ok => upload file:
  					move_uploaded_file($tmpName, $newPath);

            // Save file info into DB:
  					$detImg = new ProductImages();
  					$detImg->image = $mFileName;
  					$detImg->product_id = $product_id;

  					if(!$detImg->save()){
              return redirect()->back()->with(['type'=>'danger', 'message'=>'Uploading failed !!!']);
            }
          }
          else{
            //If not, move user back to previous page (attach alert message)
    				return redirect()->back()->with(['type'=>'danger', 'message'=>'File type is not valid']);
    			}
				}
			}
			return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Successful !!!']);
		}
		else{
			return redirect()->back()->with(['type'=>'danger', 'message'=>'Uploading failed !!!']);
		}
	}

	public function getListPrd(){
    // Get product list:
		$listPrd = Product::select('id', 'name', 'price', 'cate_id', 'created_at')
							         ->get();

		return view('admin.product.list', compact('listPrd'));
	}

	public function getDelPrd($prd_id){
    // Get detail image:
		$detailImg = Product::find($prd_id)->relateToImage->toArray();
  	 // echo "<pre>";
  	 // print_r($detailImg);
  	 // echo "</pre>";
  	 // die();

    // Delete detail image file from folder:
		foreach($detailImg as $val){
			File::delete('image/'.$val['image']);
		}

    // Delete main image from folder:
		$prd = Product::find($prd_id);
		File::delete('image/'.$prd['image']);

    // Delete product data in DB:
		$prd->delete($prd_id);

		return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Deleting successful']);
	}

	public function getEditPrd($prd_id){
    // Get category cate:
		$getListCate = Cate::select('id','name','parent_id')
							           ->get()->toArray();

    //  Get current cate info:
		$currentCate = Product::where('id', $prd_id)->first();

    // Get detsil image info:
		$detailImage = Product::find($prd_id)->relateToImage->toArray();
		// echo "<pre>";
		// print_r($currentCate);
		// echo "</pre>";
		return view('admin.product.edit', compact('getListCate', 'currentCate', 'detailImage'));
	}

	public function postEditPrd($prd_id, $user_id, Request $request){
		//Validate form:
			$this->validate($request,
      [
				'sltPrd'=>'required',
				'txtName'=>'required',
				'txtPrice'=>'required',
				'fImages'=>'image',
        'txtIntro'=>'nullable',
        'txtContent'=>'nullable',
        'txtKeywords'=>'nullable',
        'txtDescription'=>'nullable',
        'detailImages'=>'nullable'
			],
			[
				'sltPrd.required'=>'Product cate is required !!!',
				'txtName.required'=>'Product name is required !!!',
				'sltPrd.unique'=>'This product name is existed !!!',
				'txtPrice.required'=>'Product price is required !!!',
				'fImages.image'=>'The file upload is not image !!!'
			]
		);

    // Start edit product:
		$editPrd = Product::find($prd_id);

    $checkName = Product::select('id')->where('name', $request->txtName)
                                      ->where('id', '<>', $prd_id)
                                      ->first();
    if (count($checkName) > 0) {
      return redirect()->back()->with(['type'=>'alert', 'message'=>'Product name is existed !!!']);
    }
    else{
      $editPrd->name = $request->txtName;
  		$editPrd->alias = $request->txtName;
  		$editPrd->price = $request->txtPrice;
  		$editPrd->intro = $request->txtIntro;
  		$editPrd->content = $request->txtContent;
  		$editPrd->keywords = $request->txtKeywords;
  		$editPrd->description = $request->txtDescription;
  		$editPrd->user_id = $user_id;
  		$editPrd->cate_id = $request->sltPrd;

  		// Update the detail image:
  		if($request->hasFile('detailImages')){ //If files are exist...
  			$detailImgs = $_FILES['detailImages'];
  			foreach($detailImgs['name'] as $k=>$imgName){
          // Get file tmp name:
  				$tmp_name = $detailImgs['tmp_name'][$k];
  				$new_path = 'image/'.$imgName;

          // Get file extension:
          $arrEx = array('jpg', 'png');
          $arr = pathinfo($_FILES['detailImages']['name'][$k]);
          $mFileEx =  $arr['extension'];

          //Check file extension:
          if(in_array($mFileEx, $arrEx)){  // If ok => upload file:
            move_uploaded_file($tmp_name, $new_path);

            // Upload new images:
            $detImg = new ProductImages();
            $detImg->image = $imgName;
            $detImg->product_id = $editPrd->id;
            if(!$detImg->save()){
              return redirect()->back()->with(['type'=>'danger', 'message'=>'Uploading failed !!!']);
            }
          }
  			}
  		}

  	// Update the product image:
  		//Get the old file:
  		$oldFileName = $request->input('current_img');

  		// The old img path	:
  		$oldImgPath = 'image/'.$oldFileName;

  		//If there's the new img post
  		if($request->hasFile('fImages')){
  			//Get file:
  			$file = $request->file('fImages');
        // echo "<pre>";
        // print_r($file);
        // echo "</pre>";

  			//Get file name
        $fileName = $file->getClientOriginalName('fImages');

  			//Insert the new file name into DB:
  			$editPrd->image = $fileName;

  			//Upload the new file into server:
  			$imgFolder = public_path('image');

  			$file->move($imgFolder, $fileName);

  			//Check if there's an old file:
  			if(File::exists($oldImgPath)){
  				File::delete($oldImgPath);		//Delete file
  			}
  		}

  			if($editPrd->save()){   // If everything is ok
          // Move user to product list page:
  				return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Editing successful !!!']);
  			}
  			else{   // If not
          // Move user back to (attach alert message):
  				return redirect()->route('getListPrd')->with(['type'=>'danger', 'message'=>'Editing failed !!!']);
  			}
    }
	}
}
