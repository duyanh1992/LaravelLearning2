<?php $__env->startSection('content'); ?>
<div id="maincontainer">
<?php
  if(Auth::check()){
	  $user_id = Auth::user()->id;
  }
  else{
	  $user_id = 0;
  }
?>
  <section id="product">
    <div class="container">
     <!--  breadcrumb -->
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active">Category</li>
      </ul>
      <div class="row">
        <!-- Sidebar Start-->
        <aside class="col-lg-3">
         <!-- Category-->

         <!--  Best Seller -->

          <!-- Latest Product -->

          <!--  Must have -->

        </aside>
        <!-- Sidebar End-->
        <!-- Category-->
        <div class="col-lg-12">
          <!-- Category Products-->
          <section id="category">
               <!-- Sorting-->
                <div class="sorting well">
                  <div class="btn-group pull-right">
                    <button class="btn" id="list"><i class="icon-th-list"></i>
                    </button>
                    <button class="btn btn-orange" id="grid"><i class="icon-th icon-white"></i></button>
                  </div>
                </div>
               <!-- Category-->
                <section id="categorygrid">
                  <ul class="thumbnails grid">
				  <?php $__currentLoopData = $prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="col-lg-4 col-sm-6 text-center">
              <a class="prdocutname" href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><?php echo $item->name; ?></a>
              <div class="thumbnail">
                <span class="sale tooltip-test">Sale</span>
                <a href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><img alt="" src="<?php echo asset('image/'.$item->image); ?>"></a>

                <div class="pricetag" style="margin-left:40px;">
                  <span class="spiral"></span><a href="<?php echo route('addCart', [$item->id, $user_id]); ?>" class="productcart">ADD TO CART</a>
                  <div class="price">
                    <div class="pricenew"><?php echo number_format($item->price,0,',','.'); ?>đ</div>
                  </div>
                </div>
              </div>
            </li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <ul class="thumbnails list row">
					<?php $__currentLoopData = $prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <div class="thumbnail">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4">
                            <span class="offer tooltip-test" >Offer</span>
                            <a href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><img alt="" src="<?php echo asset('image/'.$item->image); ?>"></a>
                          </div>
                          <div class="col-lg-8 col-sm-8">
                            <a class="prdocutname" href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>"><?php echo $item->name; ?></a>
                            <div class="productdiscrption"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.<br>
                              <br>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stan </div>
                            <div class="pricetag">
                              <span class="spiral"></span><a href="<?php echo route('getDetailPrd', [$item->id, $item->cate_id]); ?>" class="productcart">ADD TO CART</a>
                              <div class="price">
                                <div class="pricenew"><?php echo number_format($item->price,0,',','.'); ?> đ</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div>
                    <ul class="pagination pull-right">
					  <?php if($prd->currentPage() != 1): ?>
                      <li><a href="<?php echo $prd->url($prd->currentPage() - 1); ?>">Prev</a>
                      </li>
					  <?php endif; ?>

					  <?php for($i=1;$i<=($prd->lastPage());$i++): ?>
                      <li class="<?php echo ($prd->currentPage() == $i) ? 'active' : ''; ?>">
                        <a href="<?php echo $prd->url($i); ?>"><?php echo $i; ?></a>
                      </li>
					  <?php endfor; ?>

					  <?php if($prd->currentPage() != $prd->lastPage()): ?>
                      <li><a href="<?php echo $prd->url($prd->currentPage() + 1); ?>">Next</a>
                      </li>
					  <?php endif; ?>
                    </ul>
                  </div>
                </section>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>