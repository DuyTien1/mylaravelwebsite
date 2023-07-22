@extends('layout')
@section('content')

@foreach($productdetail as $key =>$pro_de)
	<?php
        $message = Session::get('message');
        if ($message) {
            echo '<h4 style="width: 850px; text-align: center;" class="alert alert-success">'.$message.'</h4>';
            Session::put('message', null);
        }
    ?>
<h2 style="margin-top: 10px;" class="title text-center">Chi Tiết Sản Phẩm</h2>
<div class="product-details" style="padding-right: 100px; margin-top: 10px;"><!--product-details-->
	<div class="col-sm-6">
		<div class="view-product">
			<img src="{{ URL::to('uploads/product/'.$pro_de->hinhsanpham) }}" alt="" />
			<!-- <h3>Phóng To</h3> -->
		</div>	
	</div>
	<div class="col-sm-6">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{ $pro_de->tensanpham }}</h2>
			<p><b>ID: </b>{{ $pro_de->product_id }}</p>
			<img src="images/product-details/rating.png" alt="" />
			<form action="{{ URL::to('/savecart') }}" method="post">
				{{ csrf_field() }}
				<span>
					<span>{{ number_format($pro_de->gia).' '.'VNĐ' }}</span>
					<?php
						if ($pro_de->soluong > 0) {
					?>
						<label style="margin: 0 0 0 50px;">Số Lượng:</label>
						<input name="qty" type="number" min="1" value="1" />
					<?php
						}
					?>
					<input name="product_id_hidden" type="hidden" value="{{ $pro_de->product_id }}" />
					<?php
						if ($pro_de->soluong > 0) {
					?>
					<button style="margin-top: 12px;" style="" type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Thêm Vào Giỏ Hàng
					</button>
					<?php
						}
					?>
				</span>
			</form>
			<?php
				if ($pro_de->soluong <= 0) {
			?>
					<p><b>Tình Trạng: </b>Hết Hàng</p>
			<?php
				} else {
			?>
					<p><b>Tình Trạng: </b>Còn Hàng</p>
			<?php
				}
			?>
			<p><b>Trạng Thái: </b> New</p>
			<p><b>Còn Lại: </b> {{ $pro_de->soluong }}</p>
			<p><b>Thương Hiệu: </b>{{ $pro_de->tenthuonghieu }}</p>
			<p><b>Danh Mục: </b>{{ $pro_de->tendanhmuc }}</p>
			<p><b>Lượt Xem:  </b>{{ $pro_de->luotxem }} <i class="fa fa-eye" aria-hidden="true"></i></p>
			<div class="choose" style="margin-top: 20px;">
				<ul class="nav nav-pills nav-justified">
					<?php
						$customer_id = Session::get('customer_id');
						if ($customer_id) {
					?>
					<li><a href="{{ URL::to('/addfavorite/'.$pro_de->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/showcart') }}"><i class="fa fa-plus-square"></i>Xem Giỏ Hàng</a></li>
					<?php
						}else {
					?>
					<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
					<li><a href="{{ URL::to('/showcart') }}"><i class="fa fa-plus-square"></i>Xem Giỏ Hàng</a></li>
					<?php
						}
					?>
				</ul>
			</div>
			<!-- <a href=""><img src="{{ URL::to('frontend/images/share.png') }}" class="share img-responsive"  alt="" /></a> -->
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab"><i class="fa fa-info-circle"></i> Chi Tiết</a></li>
			<li><a href="#companyprofile" data-toggle="tab"><i class="fa fa-book"></i> Về Thương Hiệu {{ $pro_de->tenthuonghieu }}</a></li>
			<li><a href="#reviews" data-toggle="tab"><i class="fa fa-comment"></i> Bình Luận</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade  active in" id="details" >
		<p>{!!$pro_de->mota!!}</p>					
		</div>
		
		<div class="tab-pane fade" id="companyprofile" >
			<p>{!!$pro_de->motathuonghieu!!}</p>							
		</div>											
		<div class="tab-pane fade" id="reviews" >
		<?php
			$customer_id = Session::get('customer_id');
			if ($customer_id && $damua > 0) {
		?>
			<div class="col-sm-12">
				<p><b>Hãy Để Lại Trải Nghiệm Thực Tế Của Bạn Về Sản Phẩm Của Chúng Tôi: </b></p>
				<form action="{{ URL::to('/addcomment') }}" method="post">
					{{ csrf_field() }}
					<input name="pro_id" type="hidden" value="{{ $pro_de->product_id }}">
					<textarea style="margin-bottom: 1px;" name="comment" style="resize: none;" rows="2"></textarea>
					@if($errors->has('comment'))
						<label style="width: 778px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px;" class="alert alert-danger">
							{{ $errors->first('comment') }}
						</label>
					@endif
					<div style="width: 100%; display: flex; align-items: center; justify-content: center;">
						<button style="margin: 25px 0 26px 0;" type="submit" class="btn btn-default pull-center">
							Bình Luận
						</button>
					</div>
				</form>
			</div>
			<?php
				}
			?>
			<div class="col-sm-12">
				<div class="media commnets">
					@foreach($comments as $key => $cm)
					<div class="media-body"   style="display: flex; justify-content: space-between; align-items: center;">
						<div>
							<h1 class="media-heading" style="font-size: 20px;">{{ $cm->hoten }}</h1>
							<p style="font-size: 16px;">{{ $cm->noidung }}</p>
							<ul class="sinlge-post-meta">
								<li><i class="fa fa-calendar"></i> {{ $cm->created_at }}</li>
							</ul>
						</div>
						@if($cm->customer_id == Session::get('customer_id'))
						<div>
							<a onclick="return confirm('Bạn có chắn chắn muốn xóa bình luận này?')" class="btn btn-danger" href="{{ URL::to('deletecomment/'.$cm->comment_id) }}">Xóa</a>
						</div>
						@endif
					</div>
					@endforeach
				</div><!--Comments-->
			</div>
		</div>
	</div>
</div><!--/category-tab-->
@endforeach
						<div class="recommended_items"><!--recommended_items-->
						<h2 style="margin-top: 10px;" class="title text-center">Có Thể Bạn Quan Tâm</h2>						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($offerproduct as $key => $offer)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{ URL::to('uploads/product/'.$offer->hinhsanpham) }}" alt="" />
													<h2>{{ number_format($offer->gia).' '.'VNĐ' }}</h2>
													<p>{{ $offer->tensanpham }}</p>
													<!-- <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button> -->
												</div>
											</div>
											<div class="choose">
												<ul class="nav nav-pills nav-justified">
													<?php
														$customer_id = Session::get('customer_id');
														if ($customer_id) {
													?>
													<li><a href="{{ URL::to('/addfavorite/'.$offer->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
													<li><a href="{{ URL::to('/homeaddcart/'.$offer->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
													<?php
														}else {
													?>
													<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-plus-square"></i>Thêm Yêu Thích</a></li>
													<li><a href="{{ URL::to('/homeaddcart/'.$offer->product_id) }}"><i class="fa fa-plus-square"></i>Thêm Giỏ Hàng</a></li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
									</div>
									@endforeach															
								</div>								
							</div>
							<!-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>			 -->
						</div>
					</div><!--/recommended_items-->
@endsection   