@extends('admin.master')
@section('pageHeader', 'Cate')
@section('function', 'Edit')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
	@include('admin.blocks.validation_error')
	<form action="{!! route('postEditCate', $getCateById->id) !!}" method="POST">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltCate">
				<option value="0">Please Choose Category</option>
				<?php
					// Show category select box:
					parentCate($getListCate, 0, '', $parent_id);
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Category Name</label>
			<input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{!! old('txtCateName', isset($getCateById->name) ? $getCateById->name : null) !!}"/>
		</div>
		<div class="form-group">
			<label>Category Order</label>
			<input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" value="{!! old('txtOrder', isset($getCateById->order) ? $getCateById->order : null) !!}"/>
		</div>
		<div class="form-group">
			<label>Category Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{!! old('txtKeywords', isset($getCateById->keywords) ? $getCateById->keywords : null) !!}"/>
		</div>
		<div class="form-group">
			<label>Category Description</label>
			<textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription', isset($getCateById->description) ? $getCateById->description : null) !!}</textarea>
		</div>

		<button type="submit" name="submit" class="btn btn-default">Category Edit</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
@endsection()
