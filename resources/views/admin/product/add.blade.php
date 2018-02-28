@extends('admin.master')
@section('pageHeader', 'Product')
@section('function', 'Add')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
	@include('admin.blocks.validation_error')
	<div class="alert alert-{!! Session::get('type') !!}">
		@if(Session::get('success'))
			{!! Session::get('success') !!}
		@endif
	</div>
	<form action="{!! url('admin/admin-content/product/postAddPrd') !!}" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltPrd">
				<option value="">Please Choose Category</option>
					
				<?php 
					parentCate($getListCate);
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Name</label>
			<input class="form-control" name="txtName" placeholder="Please Enter Username" />
		</div>
		<div class="form-group">
			<label>Price</label>
			<input class="form-control" name="txtPrice" placeholder="Please Enter Password" />
		</div>
		<div class="form-group">
			<label>Intro</label>
			<textarea class="form-control" id="editor1" rows="3" name="txtIntro"></textarea>
		</div>
		<div class="form-group">
			<label>Content</label>
			<textarea class="form-control" id="editor2" rows="3" name="txtContent"></textarea>
		</div>
		<div class="form-group">
			<label>Images</label>
			<input type="file" name="fImages">
		</div>
		<div class="form-group">
			<label>Detail Images</label>
			<input type="file" name="detailImages[]" multiple>
		</div>
		<div class="form-group">
			<label>Product Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" />
		</div>
		<div class="form-group">
			<label>Product Description</label>
			<textarea class="form-control" rows="3" name="txtDescription"></textarea>
		</div>
	
		<button type="submit" class="btn btn-default">Product Add</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
@endsection()  
