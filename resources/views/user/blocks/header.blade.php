<div class="headerstrip">
	<div class="container">
		<div class="row">
			<div class="col-lg-12"> <a href="{!! url('/') !!}" class="logo pull-left"><img src="{!! url('user/img/logo.png') !!}" alt="SimpleOne" title="SimpleOne"></a> 
				<!-- Top Nav Start -->
				<div class="pull-left">
					<div class="navbar" id="topnav">
						<div class="navbar-inner">
							<ul class="nav" >
								<li><a class="home active" href="#">Home</a> </li>
								@if(Auth::check()) <!--  If user is logging in, show username, shopping cart link, and log out link  -->
									<li><a class="myaccount" href="#">{!! Auth::user()->username !!}</a> </li>
									<li><a class="shoppingcart" href="{!! route('getCartInfo', Auth::user()->id) !!}">Shopping Cart</a> </li>
									<li><a class="" href="{!! route('logout') !!}">Logout</a> </li>
								@elseif(isset($_SESSION['social_name']) && isset($_SESSION['social_id']))
									<li><a class="myaccount" href="#">{!! $_SESSION['social_name'] !!}</a> </li>
									<li><a class="shoppingcart" href="{!! route('getCartInfo', $_SESSION['social_id']) !!}">Shopping Cart</a> </li>
									<li><a class="" href="{!! route('socialLogout') !!}">Logout</a> </li>	
								@else
									<li><a class="myaccount" href="{!! url('homesite/getUserLogin') !!}">Sign In</a> </li>
								@endif									
							</ul>
						</div>
					</div>
				</div>
				<!-- Top Nav End -->
				<div class="pull-right">
					<form class="form-search top-search" method="post" name="search-frm" action="{!! route('search') !!}">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
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