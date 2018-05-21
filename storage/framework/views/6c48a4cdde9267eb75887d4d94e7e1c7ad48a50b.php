<?php $__env->startSection('pageHeader', 'User'); ?>
<?php $__env->startSection('function', 'List'); ?>
<?php $__env->startSection('content'); ?>
<?php if(Session::get('message')): ?>
	<div id="test" class="alert alert-<?php echo Session::get('type'); ?>">
		<?php echo Session::get('message'); ?>

	</div>
<?php endif; ?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Username</th>
			<th>Level</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index = 1 ?>
		<?php $__currentLoopData = $allUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr class="odd gradeX" align="center">
			<td><?php echo e($index); ?></td>
			<td><?php echo $user->username; ?></td>
			<td>
				<?php if(($user->level) == 1): ?>
				<?php echo "Admin"; ?>

				<?php else: ?>
				<?php echo "Member"; ?>

				<?php endif; ?>
			</td>
			<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="<?php echo route('getDelUser', $user->id); ?>" onclick="return delConfirm();"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo route('getEditUser', $user->id); ?>">Edit</a></td>
		</tr>
		<?php $index++ ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>