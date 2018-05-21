<?php $__env->startSection('pageHeader', 'Cate'); ?>
<?php $__env->startSection('function', 'List'); ?>
<?php $__env->startSection('content'); ?>

<div class="col-md-12">
	<!-- Show alert message  -->
	<?php echo $__env->make('admin.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show alert message -->
</div>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Category Parent</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index=1; ?>
		<?php $__currentLoopData = $getListCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr class="odd gradeX" align="center">
			<td><?php echo $index; ?></td>
			<td><?php echo $item->name; ?></td>
			<td>
				<!-- etting showed cate parent name -->
			<?php
				$cateParentName = DB::table('cates')->select('name')
								  ->where('id', $item->parent_id)
								  ->first();
				if(!isset($cateParentName->name)){
					echo 'none';
				}
				else{
					echo $cateParentName->name;
				}
			?>
			 <!-- End setting showed cate parent name -->
			</td>
			<td class="center"><i class="fa fa-trash-o fa-fw"></i><a onclick="return delConfirm();"; href="<?php echo route('getDelCate', $item['id']); ?>"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo route('getEditCate', $item['id']); ?>">Edit</a></td>
		</tr>
		<?php $index++;?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>