<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang Quản Lý Bán Hàng</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=""/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css"/>
<link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- <link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css"/> -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- calendar -->
<link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.multidatespicker.css') }}"> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
<!-- <script src="{{ asset('backend/js/raphael-min.js') }}"></script>
<script src="{{ asset('backend/js/morris.js') }}"></script> -->
<!-- <script src="{{ asset('backend/js/jquery-ui.multidatespicker.js') }}"></script> -->
<!-- <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script> -->
<!-- <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script> -->
<script src="{{ asset('backend/js/jquery.form-validator.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    window.onload = function() {
        // CKEDITOR.replace( 'ckeditor' );
        // CKEDITOR.replace( 'ckeditorbr' ); 
        $.validate({
            
		});
    };
</script>


<!-- <script type="text/javascript">
	window.onload = function() {
		$.validate({
		});
    };
</script> -->
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{ URL::to('/dashboard') }}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="nav notify-row" id="top_menu">
<?php
    $new_order = DB::table('order')
    ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
    ->select('order.*', 'customer.hoten')
    ->where('trangthai', '0')
    ->get();
    $count_order = $new_order->count();
?>

    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">{{ $count_order }}</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Có {{ $count_order }} Đơn Hàng Chưa Được Xác Nhận</p>
                </li>
                @foreach($new_order as $key => $no)
				<li>
                    <div style="padding: 0; margin: 0;" class="alert alert-info clearfix">
                        <div  class="noti-info">
                            <p>Người Đặt: {{ $no->hoten }} <br> Thời Gian: {{ $no->created_at }} <br> Tổng Tiền: {{ $no->tongtien }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
                <li>
                    <div style="padding: 0; margin: 0;" class="alert alert-info clearfix">
                        <div  class="noti-info">
                            <a href="{{ URL::to('/listorder') }}">Xem Danh Sách Đơn Đặt Hàng</a>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{ asset('backend/images/user.jpg') }}">
                <span class="username">
                    <span>{{ Session::get('admin_hoten') }}</span>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài Đặt</a></li> -->
                <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->      
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ URL::to('/dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>

				<li class="sub-menu">
                    <a href="{{ URL::to('/listorder') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Quản Lý Đơn Hàng</span>
                    </a>
                    <!-- <ul class="sub">
						<li><a href="{{ URL::to('/listorder') }}">Liệt Kê Đơn Hàng</a></li>
                    </ul> -->
                </li>                 
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-alt"></i>
                        <span>Danh Mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/addcategory') }}">Thêm Danh Mục</a></li>
						<li><a href="{{ URL::to('/listcategory') }}">Liệt Kê Danh Mục</a></li>
                    </ul>
                </li>   
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-wpforms"></i>
                        <span>Thương Hiệu Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/addbrand') }}">Thêm Thương Hiệu</a></li>
						<li><a href="{{ URL::to('/listbrand') }}">Liệt Kê Thương Hiệu</a></li>
                    </ul>
                </li> 
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ URL::to('/addproduct') }}">Thêm Sản Phẩm</a></li>
						<li><a href="{{ URL::to('/listproduct') }}">Liệt Kê sản Phẩm</a></li>
                    </ul>
                </li>    
				<li class="sub-menu">
                    <a href="{{ URL::to('/listcustomer') }}">
                        <i class="fa fa-user"></i>
                        <span>Khách Hàng</span>
                    </a>
                </li>    
                <li class="sub-menu">
                    <a href="{{ URL::to('/listcomment') }}">
                        <i class="fa fa-comment"></i>
                        <span>Bình Luận</span>
                    </a>
                </li> 
                <li class="sub-menu">
                    <a href="{{ URL::to('/statistical') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span>Thống Kê</span>
                    </a>
                </li>   
            </ul>            
		</div>
        <!-- sidebar menu end-->
    </div>


<?php
$cate1 = DB::table('product')->where('category_id', 1)->get();
$nuochoanu = 0;
foreach($cate1 as $key => $c1) {
    $nuochoanu = $nuochoanu + $c1->soluongban;
}

$cate2 = DB::table('product')->where('category_id', 2)->get();
$nuochoanam = 0;
foreach($cate2 as $key => $c2) {
    $nuochoanam = $nuochoanam + $c2->soluongban;
}

$cate3 = DB::table('product')->where('category_id', 3)->get();
$xitkhumui = 0;
foreach($cate3 as $key => $c3) {
    $xitkhumui = $xitkhumui + $c3->soluongban;
}

$cate4 = DB::table('product')->where('category_id', 4)->get();
$lankhumui = 0;
foreach($cate4 as $key => $c4) {
    $lankhumui = $lankhumui + $c4->soluongban;
}

$brand1 = DB::table('product')->where('brand_id', 1)->get();
$chanel = 0;
foreach($brand1 as $key => $b1) {
    $chanel = $chanel + $b1->soluongban;
}

$brand2 = DB::table('product')->where('brand_id', 2)->get();
$bvlgari = 0;
foreach($brand2 as $key => $b2) {
    $bvlgari = $bvlgari + $b2->soluongban;
}

$brand3 = DB::table('product')->where('brand_id', 3)->get();
$chloe = 0;
foreach($brand3 as $key => $b3) {
    $chloe = $chloe + $b3->soluongban;
}

$brand4 = DB::table('product')->where('brand_id', 4)->get();
$lancome = 0;
foreach($brand4 as $key => $b4) {
    $lancome = $lancome + $b4->soluongban;
}

$brand5 = DB::table('product')->where('brand_id', 5)->get();
$versace = 0;
foreach($brand5 as $key => $b5) {
    $versace = $versace + $b5->soluongban;
}

$brand6 = DB::table('product')->where('brand_id', 6)->get();
$dior = 0;
foreach($brand6 as $key => $b6) {
    $dior = $dior + $b6->soluongban;
}

$brand7 = DB::table('product')->where('brand_id', 7)->get();
$calvinklein = 0;
foreach($brand7 as $key => $b7) {
    $calvinklein = $calvinklein + $b7->soluongban;
}
?>


</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')		
	</section>
<!-- footer -->
		<!-- <div class="footer">
			<div class="wthree-copyright">
			<p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		</div> -->
<!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{ asset('backend/js/bootstrap.js') }}"></script>
<script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- morris JavaScript -->	


<script type="text/javascript">
    $(function() {
        $( "#datepicker" ).datepicker({
            prevText: "Tháng Trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật" ],
            duration: "slow"
        });
    });
    $(function() {
        $( "#datepicker2" ).datepicker({
            prevText: "Tháng Trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật" ],
            duration: "slow"
        });
    });
    $(function() {
        $( "#datepicker3" ).datepicker({
            prevText: "Tháng Trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật" ],
            duration: "slow"
        });
    });
    $(function() {
        $( "#datepicker4" ).datepicker({
            prevText: "Tháng Trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật" ],
            duration: "slow"
        });
    });
    $(function() {
        $( "#datepicker5" ).datepicker({
            prevText: "Tháng Trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật" ],
            duration: "slow"
        });
    });
</script>



<!-- <script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script> -->
<!-- calendar -->
	<!-- <script type="text/javascript" src="{{ asset('backend/js/monthly.js') }}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script> -->
	<!-- //calendar -->

    
    <script type="text/javascript">
        $(document).ready(function() {
            Morris.Donut({
                element: 'donut1',
                colors: ['#fc3158', '#53d769', '#147efb', '#2a2727'],
                data: [
                {label: "Nước Hoa Nữ", value: <?php echo $nuochoanu ?>},
                {label: "Nước Hoa Nam", value: <?php echo $nuochoanam ?>},
                {label: "Xịt Khử Mùi", value: <?php echo $xitkhumui ?>},
                {label: "Lăn Khử Mùi", value: <?php echo $lankhumui ?>}
                ]
            });
            // new Morris.Donut ({
            //     element: 'donut1',
            //     resize: true,
            //     colors: ['#fc3158', '#53d769', '#147efb', '#2a2727'],
            //     data: [
            //         {label: "Nước Hoa Nữ", value: 1 },
            //         {label: "Nước Hoa Nam", value: 2 },
            //         {label: "Xịt Khử Mùi", value: 3 },
            //         {label: "Lăn Khử Mùi", value: 4 }
            //     ]
            // });
        });
    </script>

<script type="text/javascript">
        $(document).ready(function() {
            Morris.Donut({
                element: 'donut2',
                colors: ['#fc3158', '#53d769', '#147efb', '#2a2727'],
                data: [
                {label: "Chanel", value: <?php echo $chanel ?>},
                {label: "BLV GARI", value: <?php echo $bvlgari ?>},
                {label: "Chloe", value: <?php echo $chloe ?>},
                {label: "LANCÔME", value: <?php echo $lancome ?>},
                {label: "VERSACE", value: <?php echo $versace ?>},
                {label: "DIOR", value: <?php echo $dior ?>},
                {label: "Calvin Klein", value: <?php echo $calvinklein ?>}
                ]
            });
            // new Morris.Donut ({
            //     element: 'donut1',
            //     resize: true,
            //     colors: ['#fc3158', '#53d769', '#147efb', '#2a2727'],
            //     data: [
            //         {label: "Nước Hoa Nữ", value: 1 },
            //         {label: "Nước Hoa Nam", value: 2 },
            //         {label: "Xịt Khử Mùi", value: 3 },
            //         {label: "Lăn Khử Mùi", value: 4 }
            //     ]
            // });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            autodisplay();

            var chart = new Morris.Line({
                element: 'chart',
                lineColors: ['#fc3158', '#53d769', '#147efb'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['tonggiatri', 'tongsoluong', 'tongdonhang'],
                labels: ['Giá Trị', 'Số Lượng Bán', 'Số Đơn Hàng']
            });

            function autodisplay () {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('/autodisplay') }}",
                    method:"POST",
                    dataType:"JSON",
                    data:{_token:_token},
            
                    success: function(data) {
                        chart.setData(data);                       
                    }
            
                    });
            }

            $('.dashboard-filter').change( function(){
                var dashboard_filter_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('/dashboard-filter') }}",
                    method:"POST",
                    dataType:"JSON",
                    data:{dashboard_filter_value:dashboard_filter_value,_token:_token},
            
                    success: function(data) {
                        chart.setData(data);                       
                    }
            
                    });
            });

            $('#btn-dashboard-filter').click( function () {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                if (from_date >= to_date) {
                    alert('Vui Lòng Chọn Lại Ngày');
                } else {
                    $.ajax({
                        url:"{{ url('/filter-by-date') }}",
                        method:"POST",
                        dataType:"JSON",
                        data:{from_date:from_date,to_date:to_date,_token:_token},
                
                        success: function(data) {
                            chart.setData(data);                       
                        }
                
                        });
                }
                }); 
        });

    </script>

<script type="text/javascript">
        $(document).ready(function(){
            $('#btn-dashboard-filter2').click( function () {
                var _token = $('input[name="_token"]').val();
                var from_date1 = $('#datepicker3').val();
                var to_date1 = $('#datepicker4').val();
                if (from_date1 >= to_date1) {
                    alert('Vui Lòng Chọn Lại Ngày');
                } else {
                    $.ajax({
                        url:"{{ url('/filter-by-date-cate') }}",
                        method:"POST",
                        dataType:"JSON",
                        data:{from_date:from_date,to_date:to_date,_token:_token},
                
                        success: function(data1) {
                            chart1.setData(data1);                       
                        }
                
                        });
                    }
                }); 
        });

    </script>
</body>
</html>
