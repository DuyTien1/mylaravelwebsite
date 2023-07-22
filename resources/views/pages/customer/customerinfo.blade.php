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
                    <h2 style="margin-top: 10px;" class="title text-center">Thông Tin Tài Khoản</h2>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Họ Và Tên</td>
                                    <td class="address">Địa Chỉ</td>
                                    <td class="email">Email</td>
                                    <td class="phone">Số Điện Thoại</td>
                                    <td style="width: 35px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_info as $key => $ci)
                                <tr>
                                    <td class="cart_product">
                                        <p>{{ $ci->hoten }}</p>
                                    </td>
                                    <td class="cart_name">
                                        <p>{{ $ci->diachi }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ $ci->email }}</p>
                                    </td>
                                    <td class="cart_total">
                                        <p>{{ $ci->sodienthoai }}</p>
                                    </td>
                                    <td style="margin-right: 5px;" class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{ URL::to('/customerupdate/'.$ci->customer_id) }}"><i class="fa fa-pencil"></i></a>
                                    </td>
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