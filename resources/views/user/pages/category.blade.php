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
          <div class="sidewidt">
            <h2 class="heading2"><span>Categories</span></h2>
            <ul class="nav nav-list categories">
			@foreach($childCate as $item)
              <li>
                <a href="{!! route('getPrdCate', $item->id) !!}">{!! $item->name !!}</a>
              </li>
			@endforeach
            </ul>
          </div>
         <!--  Best Seller -->

          <!-- Latest Product -->
          <div class="sidewidt">
            <h2 class="heading2"><span>Latest Products</span></h2>
            <ul class="bestseller">
			@foreach($latestPrd as $item)
              <li>
                <img width="50" height="50" src="{!! url('image/'.$item->image) !!}" alt="product" title="product">
                <a class="productname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
                <span class="procategory">{!! $cateName->name !!}</span>
                <span class="price">{!! number_format($item->price, 0, ',', '.') !!} VNĐ</span>
              </li>
			@endforeach
            </ul>
          </div>
          <!--  Must have -->

        </aside>
        <!-- Sidebar End-->
        <!-- Category-->
        <div class="col-lg-9">
          <!-- Category Products-->
          <section id="category">
               <!-- Sorting-->
                <div class="sorting well">
                  <form class=" form-inline pull-left" id="filterPrd">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<input type="hidden" name="cate_id" value="<?php if(isset($cate_id)) {echo $cate_id;} ?>">
                      Sort By :
                      <select name="sltOrder">
                        <option value="name_asc">Default (Name : A -> Z)</option>
                        <option value="name_desc">Name : Z -> A</option>
                        <option value="price_asc">Price : low -> high </option>
                        <option value="price_desc">Color : high -> low</option>
                      </select>
                      &nbsp;&nbsp;
                      Show:
                      <select>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>30</option>
                      </select>
                    </form>
                  <div class="btn-group pull-right">
                    <button class="btn" id="list"><i class="icon-th-list"></i>
                    </button>
                    <button class="btn btn-orange" id="grid"><i class="icon-th icon-white"></i></button>
                  </div>
                </div>
               <!-- Category-->
                <section id="categorygrid">
                  <ul class="thumbnails grid text-center">
				  @foreach($prdCate as $item)
                    <li class="col-lg-4 col-sm-6">
                      <a class="prdocutname" href="{!! route('getDetailPrd', [$item->id, $item->cate_id]) !!}">{!! $item->name !!}</a>
                      <div class="thumbnail">
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
					@endforeach()
                  </ul>
                  <ul class="thumbnails list row">
					@foreach($prdCate as $item)
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
                              <span class="spiral"></span><a href="{!! route('addCart', [$item->id, $user_id]) !!}" class="productcart">ADD TO CART</a>
                              <div class="price">
                                <div class="pricenew">{!! number_format($item->price,0,',','.') !!}đ</div>
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
					  @if($prdCate->currentPage() != 1)
                      <li><a href="{!! $prdCate->url($prdCate->currentPage() - 1) !!}">Prev</a>
                      </li>
					  @endif

					  @for($i=1;$i<=($prdCate->lastPage());$i++)
                      <li class="{!! ($prdCate->currentPage() == $i) ? 'active' : '' !!}">
                        <a href="{!! $prdCate->url($i) !!}">{!! $i !!}</a>
                      </li>
					  @endfor

					  @if($prdCate->currentPage() != $prdCate->lastPage())
                      <li><a href="{!! $prdCate->url($prdCate->currentPage() + 1) !!}">Next</a>
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
