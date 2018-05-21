<?php $__env->startSection('content'); ?>
<section id="featured" class="row mt40">
	<div class="container">
	  <h1 class="heading1"><span class="maintext">Featured Products</span><span class="subtext"> See Our Most featured Products</span></h1>
	  <ul class="thumbnails">
	  <?php
	  if(Auth::check()){
		  $user_id = Auth::user()->id;
	  }
	  else{
		  $user_id = 0;
	  }
	  ?>
	  <?php $__currentLoopData = $featuredPrd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="col-lg-3  col-sm-6">
		  <a class="prdocutname" href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><?php echo $item->name; ?></a>
		  <div class="thumbnail text-center">
			<span class="sale tooltip-test">Sale</span>
			<a href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><img alt="" src="<?php echo asset('image/'.$item->image); ?>"></a>
			<div class="pricetag">
			  <span class="spiral"></span><a href="<?php echo route('addCart', [$item->id, $user_id]); ?>" class="productcart">ADD TO CART</a>
			  <div class="price">
				<div class="pricenew"><?php echo number_format($item->price,0,',','.'); ?> đ</div>
			  </div>
			</div>
		  </div>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </ul>
	</div>
</section>

<!-- Latest Product-->
<section id="latest" class="row">
	<div class="container">
	  <h1 class="heading1"><span class="maintext">Latest Products</span><span class="subtext"> See Our  Latest Products</span></h1>
	  <ul class="thumbnails text-center">
	   <?php $__currentLoopData = $latestPrd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="col-lg-3 col-sm-6">
		  <a class="prdocutname" href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><?php echo $item->name; ?></a>
		  <div class="thumbnail">
			<a href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><img alt="" src="<?php echo asset('image/'.$item->image); ?>"></a>
			<div class="pricetag">
			  <span class="spiral"></span><a href="<?php echo route('addCart', [$item->id, $user_id]); ?>" class="productcart">ADD TO CART</a>
			  <div class="price">
				<div class="pricenew"><?php echo number_format($item->price,0,',','.'); ?> đ</div>
			  </div>
			</div>
		  </div>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </ul>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>