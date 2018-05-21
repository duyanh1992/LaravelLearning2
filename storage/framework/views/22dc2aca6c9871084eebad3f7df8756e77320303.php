<div class="headerstrip">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"> <a href="<?php echo url('/'); ?>" class="logo pull-left"><img src="<?php echo url('user/img/logo.png'); ?>" alt="SimpleOne" title="SimpleOne"></a> 
				<!-- Top Nav Start -->
				<div class="pull-left">
					<div class="navbar" id="topnav">
						<div class="navbar-inner">
							<ul class="nav" >
								<li><a class="home active" href="#">Home</a> </li>
								<?php if(Auth::check()): ?> <!--  If user is logging in, show username, shopping cart link, and log out link  -->
									<li><a class="myaccount" href="#"><?php echo Auth::user()->username; ?></a> </li>
									<li><a class="shoppingcart" href="<?php echo route('getCartInfo', Auth::user()->id); ?>">Shopping Cart</a> </li>
									<li><a class="" href="<?php echo route('logout'); ?>">Logout</a> </li>
								<?php elseif(isset($_SESSION['social_name']) && isset($_SESSION['social_id'])): ?>
									<li><a class="myaccount" href="#"><?php echo $_SESSION['social_name']; ?></a> </li>
									<li><a class="shoppingcart" href="<?php echo route('getCartInfo', $_SESSION['social_id']); ?>">Shopping Cart</a> </li>
									<li><a class="" href="<?php echo route('socialLogout'); ?>">Logout</a> </li>	
								<?php else: ?>
									<li><a class="myaccount" href="<?php echo url('homesite/getUserLogin'); ?>">Sign In</a> </li>
								<?php endif; ?>									
							</ul>
						</div>
					</div>
				</div>
				<!-- Top Nav End -->
				<div class="pull-right">
					<form class="form-search top-search" method="post" name="search-frm" action="<?php echo route('search'); ?>">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
						<?php
							if((count($errors) > 0) && ($errors->has('sText'))){
								$mes = $errors->first('sText');
							}
							else{
								$mes = 'Search Here...';
							}
						?>
						<input type="text" class="input-medium search-query" placeholder="<?php echo $mes ?>" name="sText">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>