<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\requests\CateRequest;
use App\Cate;

class CateController extends Controller
{
    public function getAdd(){
		$getListCate = Cate::select('id','name','parent_id')
							 ->get()->toArray();
		//<?php
		//echo "<pre>";
		//print_r($getListCate);
		//echo "</pre>";

		return view('admin.cate.add', compact('getListCate'));
	}
	
	public function postAdd(CateRequest $request){
		$addCate = new Cate();
		$addCate->name = $request->txtCateName;
		$addCate->alias = $request->txtCateName;
		$addCate->order = $request->txtOrder;
		$addCate->parent_id = $request->sltCate;
		$addCate->keywords = $request->txtKeywords;
		$addCate->description = $request->txtCateName;
		if($addCate->save()){
			return redirect()->route('getListCate')->with(['message'=>'Adding cate successfully !!!', 'type'=>'success']);
		}
		else{
			return redirect()->route('getAddCate')->with('message', 'Failed !!!');
		}	
	}
	
	public function getListCate(){
		$getListCate = Cate::select('id','name','parent_id')->get();
		return view('admin.cate.list', compact('getListCate'));
	}
	
	public function getDelCate($cate_id){
		$checkCate = Cate::select('id')->where('parent_id',$cate_id)->count();
		if($checkCate == 0){
			$delCate = Cate::find($cate_id);
			$delCate->delete();
			return redirect()->route('getListCate')->with(['type'=>'success', 'message'=>'Cate was deleted !!!']);
		}
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
		$getCateById = Cate::select('id','name','parent_id', 'order', 'keywords', 'description')
							->where('id',$id)
							->first();
		
		$getListCate = Cate::select('id','name','parent_id')
							->get();
		$parent_id = $getCateById->parent_id;					
		return view('admin.cate.edit',compact('getListCate', 'parent_id', 'getCateById'));
	}
	
	public function postEditCate(Request $request, $cate_id){
		$this->validate($request,
			['txtCateName'=>'required|unique:cates,name'],
			[
				'txtCateName.required'=>'cate name is required !!!',
				'txtCateName.unique'=>'cate name is existed !!!'
			]
		);
		
		$editcate = Cate::find($cate_id);
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
			return redirect()->route('getEditCate')->with('message', 'Failed !!!');
		}	
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
