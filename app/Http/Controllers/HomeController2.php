<?php

namespace App\Http\Controllers;

use Request;
use DB;

class HomeController2 extends Controller
{
    public function filterPrd(){
      if(Request::ajax()){
        $cate_id = Request::get('cate_id');

        $var = Request::get('str_key');
        $arr_key = explode('_', $var);
        $col = $arr_key[0];
        $type = $arr_key[1];

        $childCates = DB::table('cates')->select('id')
    									   ->where('parent_id', $cate_id)
    									   ->get();

    		foreach($childCates as $child_cate){
    			$childCateId[] =  $child_cate->id;
    		}

    		$prdCate = DB::table('products')->select('id', 'name', 'price', 'image', 'cate_id')
    									->whereIn('cate_id', $childCateId)
    									->orderBy($col, $type)
    						      ->paginate(6);

    		// $parentCate = DB::table('cates')->select('parent_id')
    										// ->where('id', $cate_id)
    										// ->first();

    		$childCate = DB::table('cates')->select('name', 'id')
    									   ->where('parent_id', $cate_id)
    									   ->get();

    		$latestPrd = DB::table('products')
    							->select('id', 'name', 'price', 'image', 'cate_id')
    							->whereIn('cate_id', $childCateId)
    							->skip(0)->take(4)
    							->orderBy('id', 'DESC')
    							->get();

    		$cateName = DB::table('cates')->select('name')
    									  ->where('id', $cate_id)
    									  ->first();

    		return view('user.pages.category', compact('prdCate', 'childCate', 'latestPrd', 'cateName'));
      }
    }
}
