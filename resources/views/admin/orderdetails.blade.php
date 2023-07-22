@extends('admin.layout')
@section('admin_content')
<div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông Tin Vận Chuyển
            </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên Người Đặt</th>
                    <th>Địa Chỉ</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Hình Thức Thanh Toán</th>
                    <th>Ghi Chú</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ordershipping->hoten }}</td>
                    <td>{{ $ordershipping->diachi }}</td>
                    <td>{{ $ordershipping->email }}</td>
                    <td>{{ $ordershipping->sodienthoai }}</td>
                    <td>{{ $hinhthuc }}</td>
                    <td>{{ $ordershipping->ghichu }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi Tiết Đơn Đặt Hàng
            </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderdetails as $ord)
                <tr>
                    <td>{{ $ord->tensanpham }}</td>
                    <td><img style="width: 60px;" src="{{ URL::to('uploads/product/'.$ord->hinhsanpham) }}" alt=""></td>
                    <td>{{ number_format($ord->gia).' '.'VNĐ' }}</td>
                    <td>{{ $ord->soluong }}</td>
                    <td>{{ number_format($ord->gia*$ord->soluong).' '.'VNĐ' }}</td>
                </tr>
                @endforeach
                <tr>
                    <td>Phí Ship:</td>
                    <td colspan="4"> Free</td>
                </tr>
                <tr>
                    <td>Tổng Tiền: </td>
                    <td colspan="4"> {{ number_format($tongtien).' '.'VNĐ' }}</td>
                </tr>
            </tbody>
        </table>      
    </div>
</div>
<?php
    if($trangthai == 0) {
?>
<div style="display: flex; align-item: center; justify-content: center;">
    <div>
        <a href="{{ URL::to('/confirm/'.$ord->order_id) }}" type="submit" class="btn btn-info padding-right" name="addproduct">Xác Nhận Đơn Hàng</a>
    </div>
    <div style="margin-left: 10px;">
        <a onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')" href="{{ URL::to('/cancel/'.$ord->order_id) }}" type="submit" class="btn btn-danger" name="addproduct">Hủy Đơn Hàng</a>
    </div>
</div>
</div>
<?php
    }
?>
@endsection