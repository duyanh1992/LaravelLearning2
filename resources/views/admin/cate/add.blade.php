@extends('admin.master')
@section('pageHeader', 'Cate')
@section('function', 'Add')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Begin show the error message -->
	@include('admin.blocks.validation_error')
	<!-- End show the error message -->

	<!-- Show alert message  -->
	@include('admin.blocks.message')
	<!-- End show alert message -->

	<form action="{!! route('postAddCate') !!}" method="POST">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltCate">
				<option value="0">Please Choose Category</option>
				<?php
					//Show category select box:
					parentCate($getListCate);
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Category Name</label>
			<input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="<?php echo old('txtCateName')!=null ? old('txtCateName') : null ?>"/>
		</div>
		<div class="form-group">
			<label>Category Order</label>
			<input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" value="<?php echo old('txtOrder')!=null ? old('txtOrder') : null ?>"/>
		</div>
		<div class="form-group">
			<label>Category Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords"  value="<?php echo old('txtKeywords')!=null ? old('txtKeywords') : null ?>"/>
		</div>
		<div class="form-group">
			<label>Category Description</label>
			<textarea class="form-control" rows="3" name="txtDescription"><?php echo old('txtDescription')!=null ? old('txtDescription') : null ?></textarea>
		</div>
		<button type="submit" class="btn btn-default">Category Add</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
@endsection()
