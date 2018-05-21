<?php $__env->startSection('pageHeader', 'Product'); ?>
<?php $__env->startSection('function', 'Edit'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-lg-7" style="padding-bottom:120px">

	<!-- Begin show the error message -->
	<?php echo $__env->make('admin.blocks.validation_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show the error message -->

	<!-- Show alert message  -->
	<?php echo $__env->make('admin.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show alert message -->

	<form action="<?php echo route('postEditPrd', [$currentCate->id, $currentCate->user_id]); ?>" method="POST" id="editPrdFrm" enctype='multipart/form-data'>
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
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
			<input class="form-control" name="txtName" value="<?php if(old('txtName')){echo old('txtName');} else{ echo $currentCate->name; } ?>" /><p style="color:red"><?php echo isset($errors) ? $errors->first('txtName') : null; ?></p>
		</div>
		<div class="form-group">
			<label>Price</label>
			<input class="form-control" name="txtPrice" value="<?php if(old('txtPrice')){echo old('txtPrice');} else{ echo $currentCate->price; } ?>" /><p style="color:red"><?php echo isset($errors) ? $errors->first('txtPrice') : null; ?></p>
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
			<img src="<?php echo url('image/'.$currentCate->image); ?>" alt="" />
			<p style="color:red"><?php echo isset($errors) ? $errors->first('fImages') : null; ?></p>
		</div>
		<div>
			<input type="hidden" name="current_img" value="<?php echo $currentCate->image; ?>"/>
		</div>
		<div class="form-group">
			<label>Change Images</label>
			<input type="file" name="fImages">
		</div>
		<br />
		<div>
			<?php $__currentLoopData = $detailImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="form_group detailImgBlock" id="dImg<?php echo $key; ?>">
					<img src="<?php echo url('image/'.$item['image']); ?>" alt=""  width="150px" id="<?php echo $item['id']; ?>"/>
					<a class=" imgDelBtn btn btn-danger btn-circle del_icon"><i class="fa fa-times"></i></a>
				</div>
				<br />
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>