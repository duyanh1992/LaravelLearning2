@extends('admin.master')
@section('pageHeader', 'Product')
@section('function', 'Edit')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">

	<!-- Begin show the error message -->
	@include('admin.blocks.validation_error')
	<!-- End show the error message -->

	<!-- Show alert message  -->
	@include('admin.blocks.message')
	<!-- End show alert message -->

	<form action="{!! route('postEditPrd', [$currentCate->id, $currentCate->user_id]) !!}" method="POST" id="editPrdFrm" enctype='multipart/form-data'>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltPrd">
				<option value="">Please Choose Category</option>

				<?php
					parentCate($getListCate, 0, '', $currentCate->cate_id);
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Name</label>
			<input class="form-control" name="txtName" value="<?php if(old('txtName')){echo old('txtName');} else{ echo $currentCate->name; } ?>" /><p style="color:red">{!! isset($errors) ? $errors->first('txtName') : null !!}</p>
		</div>
		<div class="form-group">
			<label>Price</label>
			<input class="form-control" name="txtPrice" value="<?php if(old('txtPrice')){echo old('txtPrice');} else{ echo $currentCate->price; } ?>" /><p style="color:red">{!! isset($errors) ? $errors->first('txtPrice') : null !!}</p>
		</div>
		<div class="form-group">
			<label>Intro</label>
			<textarea class="form-control" rows="3" id="editor1" name="txtIntro" ><?php if(old('txtIntro')){echo old('txtIntro');} else{ echo $currentCate->intro; } ?></textarea>
		</div>
		<div class="form-group">
			<label>Content</label>
			<textarea class="form-control" rows="3" id="editor2" name="txtContent" ><?php if(old('txtContent')){echo old('txtContent');} else{ echo $currentCate->content; } ?></textarea>
		</div>
		<div>
			<label>Product Images</label>
			<img src="{!! url('image/'.$currentCate->image) !!}" alt="" />
			<p style="color:red">{!! isset($errors) ? $errors->first('fImages') : null !!}</p>
		</div>
		<div>
			<input type="hidden" name="current_img" value="{!! $currentCate->image !!}"/>
		</div>
		<div class="form-group">
			<label>Change Images</label>
			<input type="file" name="fImages">
		</div>
		<br />
		<div>
			@foreach($detailImage as $key => $item)
				<div class="form_group detailImgBlock" id="dImg{!! $key !!}">
					<img src="{!! url('image/'.$item['image']) !!}" alt=""  width="150px" id="{!! $item['id'] !!}"/>
					<a class=" imgDelBtn btn btn-danger btn-circle del_icon"><i class="fa fa-times"></i></a>
				</div>
				<br />
			@endforeach
		</div>

		<div class="form-group">
			<label>Change Detail Images</label>
			<input type="file" name="detailImages[]" multiple>
		</div>
		<div class="form-group">
			<label>Product Keywords</label>
			<input class="form-control" name="txtKeywords" value="<?php if(old('txtKeywords')){echo old('txtKeywords');} else{ echo $currentCate->keywords; } ?>" />
		</div>
		<div class="form-group">
			<label>Product Description</label>
			<textarea class="form-control" name="txtDescription" rows="3" ><?php if(old('txtDescription')){echo old('txtDescription');} else{ echo $currentCate->description; } ?></textarea>
		</div>

		<button type="submit" class="btn btn-default">Product Edit</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
@endsection()
