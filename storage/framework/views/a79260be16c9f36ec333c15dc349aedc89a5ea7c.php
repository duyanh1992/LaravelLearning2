<?php $__env->startSection('pageHeader', 'User'); ?>
<?php $__env->startSection('function', 'Edit'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Begin show the error message -->
	<?php echo $__env->make('admin.blocks.validation_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show the error message -->

	<!-- Show alert message  -->
	<?php echo $__env->make('admin.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show alert message -->

	<form action="<?php echo route('postEditUser', $user['id']); ?>" method="POST">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" name="txtUser" value="<?php echo old('txtUser', isset($user['username']) ? $user['username'] : null); ?>" />
			<p style="color:red"><?php echo isset($errors) ? $errors->first('txtUser') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
			<p style="color:red"><?php echo isset($errors) ? $errors->first('txtPass') : null; ?></p>
		</div>
		<div class="form-group">
			<label>RePassword</label>
			<input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
			<p style="color:red"><?php echo isset($errors) ? $errors->first('txtRePass') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name="txtEmail" value="<?php echo old('txtEmail', isset($user['email']) ? $user['email'] : null); ?>" />
			<p style="color:red"><?php echo isset($errors) ? $errors->first('txtEmail') : null; ?></p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>