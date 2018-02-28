<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cate;
use App\ProductImages;
use File;

class ProductController extends Controller
{
    public function getAddPrd(){
		$getListCate = Cate::select('id','name','parent_id')
							 ->get()->toArray();
		return view('admin.product.add', compact('getListCate'));
	}
	
	public function postAddPrd(Request $request){
		//Validate form:
		$this->validate($request,
			[
				'sltPrd'=>'required',
				'txtName'=>'required|unique:products,name',
				'txtPrice'=>'required',
				'fImages'=>'required|image'
			],
			[
				'sltPrd.required'=>'Product cate is required !!!',
				'txtName.required'=>'Product name is required !!!',
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
						
		$addPrd = new Product();
		$addPrd->name = $request->txtName;
		$addPrd->alias = $request->txtName;
		$addPrd->price = $request->txtPrice;
		$addPrd->intro = $request->txtIntro;
		$addPrd->content = $request->txtContent;
		$addPrd->image = $fileName;
		$addPrd->keywords = $request->txtKeywords;
		$addPrd->description = $request->txtDescription;
		$addPrd->user_id = 1;
		$addPrd->cate_id = $request->sltPrd;
		if($addPrd->save()){
			$product_id = $addPrd->id;
			
			//upload file into img folder:
			if(in_array($fileExtension, $arrEx)){
				$file->move('image', $fileName);
			}	
			else{
				return redirect()->back()->with(['type'=>'danger', 'message'=>'Upload File type is not valid']);
			}
			
			// Upload muiltiple images:
			if($request->hasFile('detailImages')){
				// echo "<pre>";
				// print_r(($_FILES['detailImages']));
				// echo "</pre>";
				// die();
				foreach($_FILES['detailImages']['name'] as $key=>$detailImage){
					//Upload images:
					$mFileName = $detailImage;
					$mFileEx = $_FILES['detailImages']['type'][$key];
					$tmpName = $_FILES['detailImages']['tmp_name'][$key];
					$newPath = 'image/'.$mFileName;
					move_uploaded_file($tmpName, $newPath);
					
					$detImg = new ProductImages();
					$detImg->image = $mFileName;
					$detImg->product_id = $product_id;
					$detImg->save();
				}
			}
			return redirect()->back()->with(['type'=>'success', 'message'=>'Successful !!!']);
		}
		else{
			return redirect()->back()->with(['type'=>'danger', 'message'=>'Uploading failed !!!']);
		}	
	}
	
	public function getListPrd(){
		$listPrd = Product::select('id', 'name', 'price', 'cate_id', 'created_at')
							->get();
							
		return view('admin.product.list', compact('listPrd'));
	}
	
	public function getDelPrd($prd_id){
		$detailImg = Product::find($prd_id)->relateToImage->toArray();
		 // echo "<pre>";
		 // print_r($detailImg);
		 // echo "</pre>";
		 // die();
		foreach($detailImg as $val){
			File::delete('image/'.$val['image']);
		}
		
		$prd = Product::find($prd_id);
		File::delete('image/'.$prd['image']);
		$prd->delete($prd_id);
		
		return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Deleting successful']);
	}
	
	public function getEditPrd($prd_id){
		$getListCate = Cate::select('id','name','parent_id')
							 ->get()->toArray();
		$currentCate = Product::where('id', $prd_id)->first();	
		$detailImage = Product::find($prd_id)->relateToImage->toArray();
		// echo "<pre>";	
		// print_r($currentCate);
		// echo "</pre>";	
		return view('admin.product.edit', compact('getListCate', 'currentCate', 'detailImage'));
	}
	
	public function postEditPrd($prd_id, $user_id, Request $request){
		$editPrd = Product::find($prd_id);
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
			
		if($request->hasFile('detailImages')){
			$detailImgs = $_FILES['detailImages'];
			foreach($detailImgs['name'] as $k=>$imgName){
				$tmp_name = $detailImgs['tmp_name'][$k];
				$new_path = 'image/'.$imgName;
				move_uploaded_file($tmp_name, $new_path);	

				$detImg = new ProductImages();	
				$detImg->image = $imgName;
				$detImg->product_id = $editPrd->id;
				$detImg->save();
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
			
			if($editPrd->save()){
				return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Successful !!!']);
			}
			else{
				return redirect()->route('getListPrd')->with(['type'=>'danger', 'message'=>'Editing failed !!!']);
			}	
		}
		//If there is not the new img post => post the old img:
		else{			
			if($editPrd->save()){
				return redirect()->route('getListPrd')->with(['type'=>'success', 'message'=>'Successful !!!']);
			}
			else{
				return redirect()->route('getListPrd')->with(['type'=>'danger', 'message'=>'Editing failed !!!']);
			}
		}
	}
}
