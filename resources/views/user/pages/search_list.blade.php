@extends('user.master')
@section('content')
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
				  @foreach($prd as $item)
            <li class="col-lg-4 col-sm-6 text-center">
              <a class="prdocutname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
              <div class="thumbnail">
                <span class="sale tooltip-test">Sale</span>
                <a href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}"><img alt="" src="{!! asset('image/'.$item->image) !!}"></a>

                <div class="pricetag" style="margin-left:40px;">
                  <span class="spiral"></span><a href="{!! route('addCart', [$item->id, $user_id]) !!}" class="productcart">ADD TO CART</a>
                  <div class="price">
                    <div class="pricenew">{!! number_format($item->price,0,',','.') !!}đ</div>
                  </div>
                </div>
              </div>
            </li>
					@endforeach()
                  </ul>
                  <ul class="thumbnails list row">
					@foreach($prd as $item)
                    <li>
                      <div class="thumbnail">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4">
                            <span class="offer tooltip-test" >Offer</span>
                            <a href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}"><img alt="" src="{!! asset('image/'.$item->image) !!}"></a>
                          </div>
                          <div class="col-lg-8 col-sm-8">
                            <a class="prdocutname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
                            <div class="productdiscrption"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.<br>
                              <br>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stan </div>
                            <div class="pricetag">
                              <span class="spiral"></span><a href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}" class="productcart">ADD TO CART</a>
                              <div class="price">
                                <div class="pricenew">{!! number_format($item->price,0,',','.') !!} đ</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
					@endforeach()
                  </ul>
                  <div>
                    <ul class="pagination pull-right">
					  @if($prd->currentPage() != 1)
                      <li><a href="{!! $prd->url($prd->currentPage() - 1) !!}">Prev</a>
                      </li>
					  @endif

					  @for($i=1;$i<=($prd->lastPage());$i++)
                      <li class="{!! ($prd->currentPage() == $i) ? 'active' : '' !!}">
                        <a href="{!! $prd->url($i) !!}">{!! $i !!}</a>
                      </li>
					  @endfor

					  @if($prd->currentPage() != $prd->lastPage())
                      <li><a href="{!! $prd->url($prd->currentPage() + 1) !!}">Next</a>
                      </li>
					  @endif
                    </ul>
                  </div>
                </section>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
