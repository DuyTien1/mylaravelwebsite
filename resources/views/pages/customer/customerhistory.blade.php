@extends('pages.customer.customerlayout')
@section('content')
<section>
    <?php
        $message = Session::get('message');
        if ($message) {
            echo '<h4 style="width: 888px; text-align: center; margin-left: 46px;" class="alert alert-success">'.$message.'</h4>';
            Session::put('message', null);
        }
    ?>
    <div class="container">
        <div class="col-sm-10">
            <section id="cart_items">
                <div class="container col-sm-12">
                    <h2 style="margin-top: 10px;" class="title text-center">Lịch Sử Mua Hàng</h2>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Họ Và Tên</td>
                                    <td class="address">Tổng Tiền</td>
                                    <td class="email">Trang Thái</td>
                                    <td class="phone">Ngày Đặt</td>
                                    <td style="width: 80px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $key => $his)
                                <tr>
                                    <td class="cart_product">
                                        <p>{{ $his->hoten }}</p>
                                    </td>
                                    <td class="cart_name">
                                        <p>{{ number_format($his->tongtien).' '.'VNĐ' }}</p>
                                    </td>
                                    <?php
                                        if($his->trangthai == 0) {
                                    ?>
                                    <td class="cart_quantity">
                                        <p>Chờ Xác Nhận</p>
                                    </td>
                                    <?php
                                        } else if ($his->trangthai == 1) {
                                    ?>
                                    <td class="cart_quantity">
                                        <p>Đã Xác Nhận</p>
                                    </td>
                                    <?php
                                        } else if ($his->trangthai == 2) {
                                    ?>
                                    <td class="cart_quantity">
                                        <p>Đã Hủy Đơn</p>
                                    </td>
                                    <?php
                                        }
                                    ?>
                                    <td class="cart_total">
                                        <p>{{ $his->created_at }}</p>
                                    </td>
                                    <?php
                                        if($his->trangthai == 0) {
                                    ?>
                                    <td style="margin-right: 5px; display: flex; justify-content: space-between;" class="cart_delete">
                                    <div>
                                        <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/historydetails/'.$his->order_id) }}"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div style="margin-right: 5px;">
                                        <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/customercancel/'.$his->order_id) }}"><i class="fa fa-times"></i></a>
                                    </div>
                                    </td>
                                    <?php
                                        } else if ($his->trangthai == 1 || $his->trangthai == 2) {
                                    ?>
                                    <td style="margin-right: 5px;" class="cart_delete">
                                        <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/historydetails/'.$his->order_id) }}"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <?php
                                        } 
                                    ?>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection