@extends('pages.customer.customerlayout')
@section('content')
<section>
    <div class="container">
        <div class="col-sm-10">
            <section id="cart_items">
                <div class="container col-sm-12">
                    <h2 style="margin-top: 10px;" class="title text-center">Lịch Sử Mua Hàng</h2>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Tên Sản Phẩm</td>
                                    <td class="image">Hình Sản Phẩm</td>
                                    <td class="email">Giá</td>
                                    <td class="phone">Số Lượng</td>
                                    <td style="width: 80px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historydetails as $key => $hisd)
                                <tr>
                                    <td class="cart_product">
                                        <p>{{ $hisd->tensanpham }}</p>
                                    </td>
                                    <td class="cart_name">
                                        <p><img src="{{ URL::to('uploads/product/'.$hisd->hinhsanpham) }}" Width="80" alt=""></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ number_format($hisd->gia).' '.'VNĐ' }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ $hisd->soluong }}</p>
                                    </td>
                                    <td style="margin: 45px 0px 0px 5px;" class="cart_delete">
                                        <a style="font-size: 14px;" class="cart_quantity_delete" href="{{ URL::to('/history/'.Session::get('customer_id')) }}"><i class="fa fa-undo"></i></a>
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