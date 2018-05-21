<div class="container">
	<div id="categorymenu">
		<nav class="subnav">
			<ul class="nav-pills categorymenu">
				<li><a class="active"  href="<?php echo url('/'); ?>">Home</a></li>
				<?php
				// Get parent cate:
				$parentCate = DB::table('cates')->where('parent_id', 0)->get();
				?>
				<?php $__currentLoopData = $parentCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><a href="<?php echo route('getAllPrdByCate', $item1->id); ?>"><?php echo $item1->name; ?></a>
					<div>
						<?php
							// Get child cate:
							$childCate = DB::table('cates')->where('parent_id', $item1->id)->get();
						?>
						<ul>
						<?php $__currentLoopData = $childCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a href="<?php echo route('getPrdCate', $item2->id); ?>"><?php echo $item2->name; ?></a> </li>						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
						</ul>
					</div>
				</li>	
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</ul>
		</nav>
	</div>
</div>