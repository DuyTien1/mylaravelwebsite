<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="author" content="">
	<meta name="keywords" content="{{ $meta_kw }}">
	<meta name="robots" content="INDEX, FOLLOW">
	<link rel="canonical" href="{{ $url }}">
    <title>{{ $meta_title }}</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ ('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ ('frontend/images/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ ('frontend/images/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ ('frontend/images/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ ('frontend/images/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0123456789</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> tiennguyenduy@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div> -->
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ URL::to('/') }}"><img src="{{ URL::to('frontend/images/logo1.png') }}" alt="" /></a>
						</div>
						<!-- <div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div> -->
					</div>
					<div class="col-sm-8">
						<div class="mainmenu pull-right">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<?php
									$customer_id = Session::get('customer_id');
									if ($customer_id != NULL) {
								?>
									<li><a href="{{ URL::to('/favorite/'.Session::get('customer_id')) }}"><i class="fa fa-star"></i> Yêu Thích</a></li>
								<?php
									}else {
								?>
								<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-star"></i> Yêu Thích</a></li>
								<?php
									}
								?>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if ($customer_id != NULL && $shipping_id != NULL) {
								?>
								<li><a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
								<?php
									}else if ($customer_id != NULL && $shipping_id == NULL) {
								?>
								<li><a href="{{ URL::to('/checkout/'.$customer_id) }}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
								<?php
									}else {
								?>
								<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
								<?php
									}
								?>
								<li><a href="{{ URL::to('/showcart') }}"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									if ($customer_id == NULL) {
								?>
								<li><a href="{{ URL::to('/checklogin') }}"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
								<?php
									}else {
								?>
								<li class="dropdown"><a href="{{ URL::to('/account-info/'.Session::get('customer_id')) }}"> {{ Session::get('customer_name') }}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ URL::to('/account-info/'.Session::get('customer_id')) }}">Thông Tin Tài Khoản</a></li>	
										<li><a href="{{ URL::to('/history/'.Session::get('customer_id')) }}">Lịch Sử Mua Hàng</a></li>
										<li><a href="{{ URL::to('/favorite/'.Session::get('customer_id')) }}">Sản Phẩm Yêu Thích</a></li>
										<li><a href="{{ URL::to('/account/'.Session::get('customer_id')) }}">Thay Đổi Mật Khẩu</a></li>
										<li><a href="{{ URL::to('/customer-logout') }}">Đăng Xuất</a></li>									
                                    </ul>
                                </li> 
								<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ URL::to('/homepage') }}" class="active">Trang Chủ</a></li>

								<li class="dropdown"><a href="#">Danh Mục<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($category as $c)
                                        <li><a href="{{ URL::to('category-product/'.$c->category_id) }}">{{ $c->tendanhmuc }}</a></li>										
										@endforeach
                                    </ul>
                                </li> 

								<li class="dropdown"><a href="#">Thương Hiệu<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($brand as $b)
                                        <li><a href="{{ URL::to('brand-product/'.$b->brand_id) }}">{{ $b->tenthuonghieu }}</a></li>
										@endforeach
                                    </ul>
                                </li> 
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-4">
						<form action="{{ URL::to('/search-product') }}" autocomplete="off" method="post">
							{{ csrf_field() }}
							<div style="position: relative; display: inline-flex; height: 40px;" class="search_box pull-right">
								<div style="width: 0px;" id="search-ajax"></div>
								<input type="text" style="width: 300px;" id="keywords" name="keywords" placeholder="Tìm kiếm..."/>
								<input type="submit" style="margin-top: 0; width: 55px; color: #696763;" class="btn btn-primary btn-sm" name="search-product" value="Tìm">					
							</div>
						</form>
					</div> -->
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					@yield('banner')					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<?php
        $message = Session::get('message');
		$message_danger = Session::get('message_danger');
        if ($message) {
            echo '<h4 style="width: 1100px; text-align: center; margin-left: 210px;" class="alert alert-success">'.$message.'</h4>';
            Session::put('message', null);
        }
		if ($message_danger) {
            echo '<h4 style="width: 1100px; text-align: center; margin-left: 210px;" class="alert alert-danger">'.$message_danger.'</h4>';
            Session::put('message_danger', null);
        }
    ?>
	<section>
		<div class="container">
			<div class="row">			
				<div class="col-sm-3">					
					<div style="margin-top: 20px;" class="left-sidebar">
							<h2>Danh Mục Sản Phẩm</h2>
							<!--category-productsr-->
							<div class="panel-group category-products" id="accordian">					
								@foreach($category as $key => $cate)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="{{ URL::to('category-product/'.$cate->category_id) }}">{{ $cate->tendanhmuc }}</a></h4>
									</div>
								</div>
								@endforeach
							</div>
							<!--/category-products-->
							<!--brands_products-->
							<h2>Thương Hiệu Sản Phẩm</h2>
							<div class="panel-group category-products" id="accordian">					
								@foreach($brand as $key => $br)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="{{ URL::to('brand-product/'.$br->brand_id) }}">{{ $br->tenthuonghieu }}</a></h4>
									</div>
								</div>
								@endforeach
							</div>
							<!--/brands_products-->																	
					</div>
				</div>
				<div style="margin-top: 10px;" class="col-sm-9 padding-right">
                    @yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-Shop Real</h2>
							<p>Shop bán nước hoa uy tín hàng đầu Việt Nam</p>
						</div>
					</div>
					<div class="col-sm-7">
						<!-- <div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::to('frontend/images/iframe1.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::to('frontend/images/iframe2.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::to('frontend/images/iframe2.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ URL::to('frontend/images/iframe4.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div> -->
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{ URL::to('frontend/images/map.png') }}" alt="" />
							<p>Long Xuyên, an Giang, Việt Nam</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch Vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Hỗ Trợ</a></li>
								<li><a href="#">Liên Hệ Chúng Tôi</a></li>
								<li><a href="#">Tình Trạng Đặt Hàng</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div> -->
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính Sách Người Dùng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều Khoản Sử Dụng</a></li>
								<li><a href="#">Chính Sách Bảo Mật</a></li>
								<li><a href="#">Hệ Thống Thanh Toán</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Về Chúng Tôi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">THông Tin Công Ty</a></li>
								<li><a href="#">Vị Trí Cửa Hàng</a></li>
								<li><a href="#">Thông Tin Tuyển Dụng</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Liên Hệ</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Email Của Bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<!-- <div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div> -->
		
	</footer><!--/Footer-->
	
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
	<script src="{{ asset('frontend/zoom-master/jquery.zoom.js') }}"></script>
	<script src="{{ asset('frontend/zoom-master/jquery.zoom.min.js') }}"></script>
	
	<script type="text/javascript">
		$(document).ready( function() {
		$('img')
		.wrap('<span style="display:inline-block"></span>')
		.css('display', 'block')
		.parent()
		.zoom();
		});
	</script>


</body>
</html>