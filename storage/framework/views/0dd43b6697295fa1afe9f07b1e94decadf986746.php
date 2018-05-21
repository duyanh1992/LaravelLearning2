<?php $__env->startSection('pageHeader', 'Product'); ?>
<?php $__env->startSection('function', 'Add'); ?>
<?php $__env->startSection('content'); ?>

<!-- <?php if(isset($_POST['submit'])): ?>
	<?php if($_POST['submit'] != null): ?>
		parentCate($getListCate, 0, '', (isset($_POST['sltPrd']) ? $_POST['sltPrd'] : 0));
	<?php endif; ?>
<?php endif; ?> -->
<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Begin show the error message -->
	<?php echo $__env->make('admin.blocks.validation_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show the error message -->

	<!-- Show alert message  -->
	<?php echo $__env->make('admin.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show alert message -->

	<form action="<?php echo url('admin/admin-content/product/postAddPrd'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltPrd">
				<option value="">Please Choose Category</option>

				<!-- Show category selectbox  -->
				<?php
					parentCate($getListCate);
				?>
				<!-- End category selectbox  -->
			</select>
		</div>
		<div class="form-group">
			<label>Name</label>
			<input class="form-control" name="txtName" placeholder="Please Enter Username" value="<?php echo old('txtName', (old('txtName') != null) ? old('txtName') : null); ?>"/><p style="color:red"><?php echo isset($errors) ? $errors->first('txtName') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Price</label>
			<input class="form-control" name="txtPrice" placeholder="Please Enter Password" value="<?php echo old('txtPrice', (old('txtPrice') != null) ? old('txtPrice') : null); ?>"/><p style="color:red"><?php echo isset($errors) ? $errors->first('txtPrice') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Intro</label>
			<textarea class="form-control" id="editor1" rows="3" name="txtIntro" ><?php echo old('txtIntro', (old('txtIntro') != null) ? old('txtName') : null); ?></textarea>
		</div>
		<div class="form-group">
			<label>Content</label>
			<textarea class="form-control" id="editor2" rows="3" name="txtContent" ><?php echo old('txtContent', (old('txtContent') != null) ? old('txtName') : null); ?></textarea>
		</div>
		<div class="form-group">
			<label>Images</label>
			<input type="file" name="fImages"><p style="color:red"><?php echo isset($errors) ? $errors->first('fImages') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Detail Images</label>
			<input type="file" name="detailImages[]" multiple>
		</div>
		<div class="form-group">
			<label>Product Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="<?php echo old('txtKeywords', (old('txtKeywords') != null) ? old('txtName') : null); ?>"/>
		</div>
		<div class="form-group">
			<label>Product Description</label>
			<textarea class="form-control" rows="3" name="txtDescription"><?php echo old('txtDescription', (old('txtDescription') != null) ? old('txtName') : null); ?></textarea>
		</div>

		<button type="submit" class="btn btn-default">Product Add</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>