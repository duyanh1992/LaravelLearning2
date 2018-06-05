<?php $__env->startSection('content'); ?>
<?php if(isset($prd_list)): ?>
<?php
  if(Auth::check()){
    $user_id = Auth::user()->id;
  }
  else{
    $user_id = 0;
  }
?>
<div id="maincontainer">
  <section id="product">
    <div class="container">
     <!--  breadcrumb --> 
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active"> Shopping Cart</li>
      </ul>       
      <h1 class="heading1"><span class="maintext"> Shopping Cart</span><span class="subtext"> All items in your  Shopping Cart</span></h1>
      <!-- Cart-->
      <div class="cart-info">
        <table class="table table-striped table-bordered">
          <tr>
            <th class="image">Image</th>
            <th class="name">Product Name</th>
            <th class="quantity">Qty</th>
              <th class="total">Action</th>
            <th class="price">Unit Price</th>
            <th class="total">Total</th>
           
          </tr>
		  <form name="frm" method="post">
		  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
      <input type="hidden" name="project_path" value="<?php echo url('/'); ?>"/>
			  <?php $totalBill = 0 ?>
			  <?php $__currentLoopData = $prd_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>		 
			  <tr>
				<td class="image"><a href="#"><img title="product" alt="product" src="<?php echo asset('image/'.$item->options->img); ?>" height="150" width="150"></a></td>
				<td  class="name"><a href="#"><?php echo $item->name; ?></a></td>
				<td class="quantity">
					<input type="text" size="3" value="<?php echo $item->qty; ?>" name="quantity" class="col-lg-1">           
          <input type="hidden" name="rowId" value="<?php echo $item->rowId; ?>"/>
					<input type="hidden" name="userId" value="<?php echo $user_id; ?>"/>
				</td>
				 <td class="total"> 
					<a href="#"><img class="tooltip-test" data-original-title="Update" src="<?php echo asset('user/img/update.png'); ?>" alt=""></a>
					<a href="<?php echo route('getDelCart', [$item->rowId, $user_id]); ?>" ><img class="tooltip-test" data-original-title="Remove"  src="<?php echo asset('user/img/remove.png'); ?>" alt=""></a>
				</td>          
				 
				<td class="price"><?php echo number_format($item->price, 0 , ',', '.'); ?> VNĐ</td>
				<td class="total"><?php echo number_format(($item->price * $item->qty), 0 , ',', '.'); ?> VNĐ</td> 
				<?php $totalBill+= ($item->price * $item->qty);?> 
			  </tr>  
			  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </form>
        </table>
      </div>
      
      <div class="container">
      <div>
          <div class="col-lg-4 pull-right">
            <table class="table table-striped table-bordered ">             
              <tr>
                <td><span class="extra bold totalamout">Total :</span></td>
                <td><span class="bold totalamout"><?php echo number_format($totalBill, 0 , ',', '.'); ?> VNĐ</span></td>
              </tr>
            </table>
            <input type="submit" value="CheckOut" class="btn btn-orange pull-right">
            <input type="submit" value="Continue Shopping" class="btn btn-orange pull-right mr10">
          </div>
        </div>
        </div>
    </div>
  </section>
</div>
<?php else: ?>
  <p style="color:orange; text-align: center; font-size: 20px; margin-top: 20px">There's nothing in your cart</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>