<?php $__env->startSection('pageHeader', 'Cate'); ?>
<?php $__env->startSection('function', 'Edit'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-lg-7" style="padding-bottom:120px">
	<?php echo $__env->make('admin.blocks.validation_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form action="<?php echo route('postEditCate', $getCateById->id); ?>" method="POST">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
		<div class="form-group">
			<label>Category Parent</label>
			<select class="form-control" name="sltCate">
				<option value="0">Please Choose Category</option>
				<?php 
					parentCate($getListCate, 0, '', $parent_id);
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Category Name</label>
			<input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="<?php echo old('txtCateName', isset($getCateById->name) ? $getCateById->name : null); ?>"/>
		</div>
		<div class="form-group">
			<label>Category Order</label>
			<input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" value="<?php echo old('txtOrder', isset($getCateById->order) ? $getCateById->order : null); ?>"/>
		</div>
		<div class="form-group">
			<label>Category Keywords</label>
			<input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="<?php echo old('txtKeywords', isset($getCateById->keywords) ? $getCateById->keywords : null); ?>"/>
		</div>
		<div class="form-group">
			<label>Category Description</label>
			<textarea class="form-control" rows="3" name="txtDescription"><?php echo old('txtDescription', isset($getCateById->description) ? $getCateById->description : null); ?></textarea>
		</div>

		<button type="submit" name="submit" class="btn btn-default">Category Edit</button>
		<button type="reset" class="btn btn-default">Reset</button>
	<form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>