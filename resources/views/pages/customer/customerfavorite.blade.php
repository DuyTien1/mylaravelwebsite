@extends('pages.customer.customerlayout')
@section('content')
<section>
    <?php
        $message = Session::get('message');
		$message_danger = Session::get('message_danger');
        if ($message) {
            echo '<h4 style="width: 888px; text-align: center; margin-left: 46px;" class="alert alert-success">'.$message.'</h4>';
            Session::put('message', null);
        }
		if ($message_danger) {
            echo '<h4 style="width: 888px; text-align: center; margin-left: 46px;" class="alert alert-danger">'.$message_danger.'</h4>';
            Session::put('message_danger', null);
        }
    ?>
    <div class="container">
        <div class="col-sm-10">
            <section id="cart_items">
                <div class="container col-sm-12">
                    <h2 style="margin-top: 10px;" class="title text-center">Sản Phẩm Yêu Thích</h2>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Tên Sản Phẩm</td>
                                    <td class="image">Hình Sản Phẩm</td>
                                    <td class="email">Giá</td>
                                    <td style="width: 80px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($favorite_data as $key => $fd)
                                <tr>
                                    <td class="cart_product">
                                        <p>{{ $fd->tensanpham }}</p>
                                    </td>
                                    <td class="cart_name">
                                        <p><img src="{{ URL::to('uploads/product/'.$fd->hinhsanpham) }}" Width="80" alt=""></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ number_format($fd->gia).' '.'VNĐ' }}</p>
                                    </td>
                                    <td style="margin:45px 5px 0 0; display: flex; justify-content: space-between;" class="cart_delete">
                                        <div>
                                            <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/homeaddcart/'.$fd->product_id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                        <div>
                                            <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/deletefavorite/'.$fd->product_id) }}"><i class="fa fa-times"></i></a>
                                        </div>
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