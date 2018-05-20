@extends('admin.master')
@section('pageHeader', 'User')
@section('function', 'Edit')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Begin show the error message -->
	@include('admin.blocks.validation_error')
	<!-- End show the error message -->

	<!-- Show alert message  -->
	@include('admin.blocks.message')
	<!-- End show alert message -->

	<form action="{!! route('postEditUser', $user['id']) !!}" method="POST">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" name="txtUser" value="{!! old('txtUser', isset($user['username']) ? $user['username'] : null) !!}" />
			<p style="color:red">{!! isset($errors) ? $errors->first('txtUser') : null !!}</p>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
			<p style="color:red">{!! isset($errors) ? $errors->first('txtPass') : null !!}</p>
		</div>
		<div class="form-group">
			<label>RePassword</label>
			<input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
			<p style="color:red">{!! isset($errors) ? $errors->first('txtRePass') : null !!}</p>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail', isset($user['email']) ? $user['email'] : null) !!}" />
			<p style="color:red">{!! isset($errors) ? $errors->first('txtEmail') : null !!}</p>
		</div>
		<div class="form-group">
			<label>User Level</label>
			<label class="radio-inline">
				<input name="rdoLevel" value="1" <?php if((old('rdoLevel') == null) || old('rdoLevel') == 1) echo "checked"; ?> type="radio">Admin
			</label>
			<label class="radio-inline">
				<input name="rdoLevel" value="2" <?php if(old('rdoLevel') == 2) echo "checked"; ?> type="radio">Member
			</label>
		</div>
		<button type="submit" class="btn btn-default">User Edit</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
@endsection()
