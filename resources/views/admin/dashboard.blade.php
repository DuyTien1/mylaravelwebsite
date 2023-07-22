@extends('admin.layout')
@section('admin_content')
<h2 style="text-align: center; font-weight: bold; color: #000000;">Thống Kê Doanh Số Đơn Hàng</h2>
<div class="row">
    <form autocomplete="off" style="display: flex; justify-content: center; align-item: center; margin: 10px 0 10px 0;">
        @csrf
        <div class="col-sm-2" >
            <p style="text-align: center; font-weight: bold;">Từ Ngày<input class="dashboard-filter form-control" type="text" id="datepicker"></p>
        </div>
        <div class="col-sm-2">
            <p style="text-align: center; font-weight: bold;">Đến Ngày<input class="dashboard-filter form-control" type="text" id="datepicker2"></p>
        </div>
        <div class="col-sm-2">
            <p style="text-align: center; font-weight: bold;">Lọc Theo  
                <select class="dashboard-filter form-control">
                    <option>--Lọc Theo--</option>
                    <option value="7ngay">7 Ngày Qua</option>
                    <option value="thangtruoc">Tháng Trước</option>
                    <option value="thangnay">Tháng Này</option>
                    <option value="365ngay">365 Ngày Qua</option>
                </select>
            </p>
        </div>
        <div class="col-sm-2">
            <p style="text-align: center; font-weight: bold;">
                <input style="margin-top: 21px;" type="button" id="btn-dashboard-filter" class="btn btn-success btn-dashboard-filter form-control" value="Thống Kê">
            </p>
        </div>
    </form>
</div>
<div class="col-sm-12">
    <div id="chart" style="height: 300px;"></div>
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


<div class="row" style="margin-bottom: 20px;">
    <div class="col-sm-6">
    <h2 style="text-align: center; font-weight: bold; color: #000000; margin: 0 0 10px 0;">Sản Phẩm Đã Bán Theo Danh Mục</h2>
        <div id="donut1"></div>
    </div>
    <div class="col-sm-6">
    <h2 style="text-align: center; font-weight: bold; color: #000000; margin: 0 0 10px 0;">Sản Phẩm Đã Bán Theo Thương Hiệu</h2>
        <div id="donut2"></div>
    </div>
</div>

<div class="row">
    <?php
        $view = DB::table('product')->get();
        $countv = 0;
        foreach ($view as $key => $v) {
            $countv = $countv + $v->luotxem;
        }
    ?>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Lượt Xem</h4>
                <h3>{{ $countv }}</h3>
                <p>Tổng Lượt Truy Cập Sản Phẩm</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <?php
        $customer = DB::table('customer')->get();
        $countc = 0;
        foreach ($customer as $key => $c) {
            $countc = $countc + 1;
        }
    ?>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-users" ></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Khách Hàng</h4>
                <h3>{{ $countc }}</h3>
                <p>Tổng Số Tài Khoản Người Dùng</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <?php
        $sell = DB::table('order')->get();
        $counts = 0;
        foreach ($sell as $key => $s) {
            $id = $s->order_id;
            $sells = DB::table('orderdetails')->where('order_id', $id)->get();
            foreach ($sells as $key => $es) {
                $counts = $counts + $es->soluong;
            }
        }
    ?>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-usd"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Sản Phẩm</h4>
                <h3>{{ $counts }}</h3>
                <p>Tổng Số Sản Phẩm Bán Được</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <?php
        $order = DB::table('order')->get();
        $counto = 0;
        foreach ($order as $key => $o) {
            $counto = $counto + 1;
        }
    ?>
    <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4" style="height: 154.83px;">
            <div class="col-md-4 market-update-right">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="col-md-8 market-update-left">
                <h4>Đơn Hàng</h4>
                <h3>{{ $counto }}</h3>
                <p>Tổng Số Đơn Hàng Đã Xác Nhận</p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection
