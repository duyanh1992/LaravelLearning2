<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CateRequest;
use App\Cate;
use Validator;

class CateController extends Controller
{
    public function getAdd(){
      // Get category list:
  		$getListCate = Cate::select('id','name','parent_id')
  							 ->get()->toArray();

  		return view('admin.cate.add', compact('getListCate'));
  	}

	public function postAdd(CateRequest $request){
    // Add new cate into DB:
		$addCate = new Cate();
		$addCate->name = $request->txtCateName;
		$addCate->alias = $request->txtCateName;
		$addCate->order = $request->txtOrder;
		$addCate->parent_id = $request->sltCate;
		$addCate->keywords = $request->txtKeywords;
		$addCate->description = $request->txtCateName;
		if($addCate->save()){ // if adding new cate is successful => move user to category list page
			return redirect()->route('getListCate')->with(['message'=>'Adding cate successfully !!!', 'type'=>'success']);
		}
		else{ // if adding new cate is unsuccessful => send alert messages:
			return redirect()->route('getAddCate')->with(['message'=>'Failed !!!', 'type'=>'alert']);
		}
	}

	public function getListCate(){
    // Get category list:
		$getListCate = Cate::select('id','name','parent_id')->get();

		return view('admin.cate.list', compact('getListCate'));
	}

	public function getDelCate($cate_id){
    // Check if the requested id is a parent id?
		$checkCate = Cate::select('id')->where('parent_id',$cate_id)->count();
      // If no, delete this product:
		if($checkCate == 0){
			$delCate = Cate::find($cate_id);
			$delCate->delete();
			return redirect()->route('getListCate')->with(['type'=>'success', 'message'=>'Cate was deleted !!!']);
		}
    // If yes, show alert message:
		else{
			return redirect()->route('getListCate')->with(['type'=>'danger', 'message'=>'Sorry, you cannot delete this cate']);
			/*echo "<script type='text/javascript'>
					alert('Sorry, you cannot delete this cate');
					window.location = '";
					echo route('getListCate');
			echo "'
				  </script>"; */
		}
	}

	public function getEditCate($id){
    // get category info by id:
		$getCateById = Cate::select('id','name','parent_id', 'order', 'keywords', 'description')
							->where('id',$id)
							->first();

    // Get all category list
		$getListCate = Cate::select('id','name','parent_id')
							->get();

    // Get parent id of requested product
		$parent_id = $getCateById->parent_id;
		return view('admin.cate.edit',compact('getListCate', 'parent_id', 'getCateById'));
	}

	public function postEditCate(Request $request, $cate_id){
    // Validate form:
		$this->validate($request,
		[
			'txtCateName'=>'required'
		],
		[

			'txtCateName.required'=>'cate name is required !!!',
		]);

    // Editing category:


		$editcate = Cate::find($cate_id);
	    if (count($editcate) > 0) {
    		$checkCateName = Cate::select('id')
    								->where('name', $request->txtCateName)
    								->where('id','<>', $cate_id)
    								->first();
    								
			// var_dump($checkCateName);
			// die();

	    	if (count($checkCateName) > 0) {
	    		return redirect()->back()->with(['message'=>'Cate name is existed !!!', 'type'=>'danger']);
	    	}

	    	else{
	    		$editcate->name = $request->txtCateName;
		  		$editcate->alias = $request->txtCateName;
		  		$editcate->order = $request->txtOrder;
		  		$editcate->parent_id = $request->sltCate;
		  		$editcate->keywords = $request->txtKeywords;
		  		$editcate->description = $request->txtCateName;

		  		if($editcate->save()){
		  			return redirect()->route('getListCate')->with(['message'=>'Editing cate successfully !!!', 'type'=>'success']);
		  		}
		  		else{
		  			return redirect()->route('getListCate')->with(['message'=>'Failed !!!', 'type'=>'alert']);
		  		}
	    	}	
	    }
	}
}
