<?php $__env->startSection('pageHeader', 'Cate'); ?>
<?php $__env->startSection('function', 'Add'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Begin show the error message -->
	<?php echo $__env->make('admin.blocks.validation_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show the error message -->

	<form action="<?php echo route('postAddCate'); ?>" method="POST">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
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
			<input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" />
		</div>
		<div class="form-group">
			<label>Category Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" />
		</div>
		<div class="form-group">
			<label>Category Description</label>
			<textarea class="form-control" rows="3" name="txtDescription"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Category Add</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>