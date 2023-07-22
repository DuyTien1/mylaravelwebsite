@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 style="margin-top: 10px;" class="title text-center">Kết Quả Tìm Kiếm</h2>
						@foreach($search_result as $key => $sr)
						<a href="{{ URL::to('product-detail/'. $sr->product_id) }}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ URL::to('uploads/product/'.$sr->hinhsanpham) }}" alt="" />
											<h2>{{ number_format($sr->gia).' '.'VNĐ' }}</h2>
											<p>{{ $sr->tensanpham }}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
										</div>										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm So Sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						</a>
						@endforeach
</div><!--features_items-->
@endsection