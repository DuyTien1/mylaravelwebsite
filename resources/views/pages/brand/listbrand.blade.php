@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
	@foreach($brandname as $key => $brname)
	<h2 style="margin-top: 10px;" class="title text-center">{{ $brname->tenthuonghieu }}</h2>
	@endforeach
	@foreach($listproduct as $key => $listpro)
	<a href="{{ URL::to('product-detail/'. $listpro->product_id) }}">
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
					<div class="productinfo text-center"  style="height: 400px;">
						<img height="255" src="{{ URL::to('uploads/product/'.$listpro->hinhsanpham) }}" alt="" />
						<h2>{{ number_format($listpro->gia).' '.'VNĐ' }}</h2>
						<h4>{{ $listpro->tensanpham }}</h4>
						<p>Thương Hiệu: {{ $listpro->tenthuonghieu }}</p>
						<p>Danh Mục: {{ $listpro->tendanhmuc }}</p>
						<!-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào giỏ Hàng</a> -->
					</div>
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<?php
						$customer_id = Session::get('customer_id');
						if ($customer_id) {
					?>
					<li><a href="{{ URL::to('/addfavorite/'.$listpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$listpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
					<?php
						}else {
					?>
					<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$listpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</div>	
	</a>																
	@endforeach						
</div><!--features_items-->										
@endsection
