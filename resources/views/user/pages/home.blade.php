@extends('user.master')
@section('content')
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
	  @foreach($featuredPrd as $item)
		<li class="col-lg-3  col-sm-6">
		  <a class="prdocutname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
		  <div class="thumbnail text-center">
			<span class="sale tooltip-test">Sale</span>
			<a href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}"><img alt="" src="{!! asset('image/'.$item->image) !!}"></a>
			<div class="pricetag">
			  <span class="spiral"></span><a href="{!! route('addCart', [$item->id, $user_id]) !!}" class="productcart">ADD TO CART</a>
			  <div class="price">
				<div class="pricenew">{!! number_format($item->price,0,',','.') !!} đ</div>
			  </div>
			</div>
		  </div>
		</li>
		@endforeach
	  </ul>
	</div>
</section>

<!-- Latest Product-->
<section id="latest" class="row">
	<div class="container">
	  <h1 class="heading1"><span class="maintext">Latest Products</span><span class="subtext"> See Our  Latest Products</span></h1>
	  <ul class="thumbnails text-center">
	   @foreach($latestPrd as $item)
		<li class="col-lg-3 col-sm-6">
		  <a class="prdocutname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
		  <div class="thumbnail">
			<a href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}"><img alt="" src="{!! asset('image/'.$item->image) !!}"></a>
			<div class="pricetag">
			  <span class="spiral"></span><a href="{!! route('addCart', [$item->id, $user_id]) !!}" class="productcart">ADD TO CART</a>
			  <div class="price">
				<div class="pricenew">{!! number_format($item->price,0,',','.') !!} đ</div>
			  </div>
			</div>
		  </div>
		</li>
		@endforeach()
	  </ul>
	</div>
</section>
@endsection