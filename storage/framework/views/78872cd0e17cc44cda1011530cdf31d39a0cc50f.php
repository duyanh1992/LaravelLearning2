<?php $__env->startSection('pageHeader', 'Product'); ?>
<?php $__env->startSection('function', 'List'); ?>
<?php $__env->startSection('content'); ?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<!-- Show alert message  -->
	<?php echo $__env->make('admin.blocks.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- End show alert message -->
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Date</th>
			<th>Category</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index=1; ?>
		<?php $__currentLoopData = $listPrd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr class="odd gradeX" align="center">
			<td><?php echo $index; ?></td>
			<td><?php echo $item->name; ?></td>
			<td><?php echo number_format($item->price,0,',','.'); ?> VNĐ</td>
			<td><?php echo Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();?></td>
			<td>
			<?php
				// Select cate name by cate id
				$cateName = DB::table('cates')
												->select('name')
												->where('id',$item->cate_id)
												->first();
				echo $cateName->name;
			?>
			</td>
			<td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="<?php echo route('getDelPrd', $item->id); ?>" onclick="return delConfirm();"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo route('getEditPrd', $item->id); ?>">Edit</a></td>
		</tr>
		<?php $index++; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>