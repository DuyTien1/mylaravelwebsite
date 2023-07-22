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
    <h2 style="margin-top: 10px;" class="title text-center">{{ $filtername }}</h2>
	@foreach($filterproduct as $key => $filterpro)
	<a href="{{ URL::to('product-detail/'. $filterpro->product_id) }}">
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="{{ URL::to('uploads/product/'.$filterpro->hinhsanpham) }}" alt="" />
					<h2>{{ number_format($filterpro->gia).' '.'VNĐ' }}</h2>
					<h4>{{ $filterpro->tensanpham }}</h4>
					<p>Thương Hiệu: {{ $filterpro->tenthuonghieu }}</p>
					<p>Danh Mục: {{ $filterpro->tendanhmuc }}</p>
					<!-- <a href="{{ URL::to('/savecart') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a> -->
				</div>										
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<?php
						$customer_id = Session::get('customer_id');
						if ($customer_id) {
					?>
					<li><a href="{{ URL::to('/addfavorite/'.$filterpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$filterpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
					<?php
						}else {
					?>
					<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/homeaddcart/'.$filterpro->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
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
	<span>{!! $filterproduct->links() !!}</span>
</div>
@endsection