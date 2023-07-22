@extends('layout')
@section('content')
<div style="display: flex; justify-content: center;">
	<form action="{{ URL::to('/filterproduct') }}" method="post">
		{{ csrf_field() }}
		<div style="margin-right: 5px;" class="form-group">
			<select class="form-control" style="width: 400px;" id="select1" name="sort">
				<option value="0">---Lọc Sản Phẩm---</option>
				<option value="1">Giá Tăng Dần</option>
				<option value="2">Giá Giảm Dần</option>
				<option value="3">Tên Từ A->Z</option>
				<option value="4">Tên Từ Z->A</option>
			</select>
		</div>
		<div class="form-group" style="display: inline-flex;">
			<input style="width: 200px;" class="form-control" type="number" min="1" placeholder="Từ" name="minprice">
			<input style="width: 200px;" class="form-control" type="number" min="1" placeholder="Đến" name="maxprice">
		</div>
		<button style="margin: 0 0 4px 5px;" class="btn btn-primary">Lọc</button>
	</form>
</div>
<div class="features_items"><!--features_items-->
	<h2 style="margin-top: 10px;" class="title text-center">Sản Phẩm Mới Nhất</h2>
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
					<!-- <a href="{{ URL::to('/savecart') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a> -->
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
<div style="display: flex; justify-content: center; align-item: center;">
	<span>{!! $listproduct->links() !!}</span>
</div>
<div class="features_items"><!--features_items-->
	<h2 style="margin-top: 10px;" class="title text-center">Được Xem Nhiều Nhất</h2>
	@foreach($viewproduct as $key => $viewpro)
	<a href="{{ URL::to('product-detail/'. $viewpro->product_id) }}">
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="{{ URL::to('uploads/product/'.$viewpro->hinhsanpham) }}" alt="" />
					<h2>{{ number_format($viewpro->gia).' '.'VNĐ' }}</h2>
					<h4>{{ $viewpro->tensanpham }}</h4>
					<p>Thương Hiệu: {{ $viewpro->tenthuonghieu }}</p>
					<p>Danh Mục: {{ $viewpro->tendanhmuc }}</p>
					<!-- <a href="{{ URL::to('/savecart') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a> -->
				</div>										
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<?php
						$customer_id = Session::get('customer_id');
						if ($customer_id) {
					?>
					<li><a href="{{ URL::to('/addfavorite/'.$viewpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$viewpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
					<?php
						}else {
					?>
					<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$viewpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
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
@section('banner')
<div id="slider-carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
		<li data-target="#slider-carousel" data-slide-to="1"></li>
		<li data-target="#slider-carousel" data-slide-to="2"></li>
		<li data-target="#slider-carousel" data-slide-to="3"></li>
	</ol>
	
	<div class="carousel-inner">
		<div class="item active">
			<div class="col-sm-6">
				<h1><span>E</span>-Shop Real</h1>
				<p>Shop bán nước hoa chính hãng uy tín hàng đầu Việt Nam. </p>
				<p>Có nhiều thương hiệu nổi tiếng khắp toàn cầu tha hồ lựa chọn. </p>
				<p>Đảm bảo sản phẩm đến được tay khách hàng nhanh chóng và tiện lợi. </p>
				<!-- <button type="button" class="btn btn-default get">Mua Ngay</button> -->
			</div>
			<div class="col-sm-6">
				<img src="{{('frontend/images/banner1.jpg')}}" class="girl img-responsive" alt="" />
				<!-- <img src="{{('frontend/images/pricing.png')}}"  class="pricing" alt="" /> -->
			</div>
		</div>
		<div class="item">
			<div class="col-sm-6">
				<h1><span>E</span>-Shop Real</h1>
				<p>Shop bán nước hoa chất lượng đảm bảo hàng đầu Việt Nam. </p>
				<p>Có nhiều thương hiệu nổi tiếng khắp toàn cầu tha hồ lựa chọn. </p>
				<p>Đảm bảo sản phẩm đến được tay khách hàng nhanh chóng và tiện lợi. </p>
				<!-- <button type="button" class="btn btn-default get">Mua Ngay</button> -->
			</div>
			<div class="col-sm-6">
				<img src="{{ ('frontend/images/banner2.jpg') }}" class="girl img-responsive" alt="" />
				<!-- <img src="{{ ('frontend/images/pricing.png') }}"  class="pricing" alt="" /> -->
			</div>
		</div>
		
		<div class="item">
			<div class="col-sm-6">
				<h1><span>E</span>-Shop Real</h1>
				<p>Shop bán nước hoa chất lượng đảm bảo hàng đầu Việt Nam. </p>
				<p>Có nhiều thương hiệu nổi tiếng khắp toàn cầu tha hồ lựa chọn. </p>
				<p>Đảm bảo sản phẩm đến được tay khách hàng nhanh chóng và tiện lợi. </p>
				<!-- <button type="button" class="btn btn-default get">Mua Ngay</button> -->
			</div>
			<div class="col-sm-6">
				<img src="{{ ('frontend/images/banner3.jpg') }}" class="girl img-responsive" alt="" />
				<!-- <img src="{{ ('frontend/images/pricing.png') }}" class="pricing" alt="" /> -->
			</div>
		</div>
		<div class="item">
			<div class="col-sm-6">
				<h1><span>E</span>-Shop Real</h1>
				<p>Shop bán nước hoa chất lượng đảm bảo hàng đầu Việt Nam. </p>
				<p>Có nhiều thương hiệu nổi tiếng khắp toàn cầu tha hồ lựa chọn. </p>
				<p>Đảm bảo sản phẩm đến được tay khách hàng nhanh chóng và tiện lợi. </p>
				<!-- <button type="button" class="btn btn-default get">Mua Ngay</button> -->
			</div>
			<div class="col-sm-6">
				<img src="{{ ('frontend/images/banner4.jpg') }}" class="girl img-responsive" alt="" />
				<!-- <img src="{{ ('frontend/images/pricing.png') }}" class="pricing" alt="" /> -->
			</div>
		</div>
		
	</div>
	
	<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
		<i class="fa fa-angle-left"></i>
	</a>
	<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
		<i class="fa fa-angle-right"></i>
	</a>
</div>
@endsection





