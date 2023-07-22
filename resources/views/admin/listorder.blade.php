@extends('admin.layout')
@section('admin_content')
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<p class="text-alert">'.$message.'</p>';
        Session::put('message', null);
    }
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt Kê Danh Sách Đơn Đặt Hàng
                </div>
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <!-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                </label>
                </th> -->
                <th>Tên Người Đặt</th>
                <th>Tổng Giá Tiền</th>
                <th>Trạng Thái</th>
                <th>Ngày Giờ Tạo</th>
                <th>Ngày Giờ Xác Nhận</th>
                <th style="width: 30px;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $key => $or)
            <tr>
                <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
                <td>{{ $or -> hoten }}</td>
                <td>{{ number_format($or -> tongtien).' '.'VNĐ' }}</td>
                <?php
                    if($or->trangthai == 0) {
                ?>
                <td>Chờ Xác Nhận</td>
                <?php
                    } else if ($or->trangthai == 1) {
                ?>
                <td>Đã Xác Nhận Đơn</td>
                <?php
                    } else if ($or->trangthai == 2) {
                ?>
                <td>Đã Hủy Đơn</td>
                <?php
                    }
                ?>
                <td>
                    {{ $or->created_at }}
                </td>
                <td>
                    {{ $or->updated_at }}
                </td>
                <td>
                <?php
                    if($or->trangthai == 0 || $or->trangthai == 1) {
                ?>
                <a href="{{ URL::to('/showorderdetails/'.$or->order_id) }}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-eye text-success text-active"></i>
                </a>
                <?php
                    } else if ($or->trangthai == 2) {
                ?>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')" href="{{ URL::to('/deleteorder/'.$or->order_id) }}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
                <?php
                    }
                ?>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                
                <!-- <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div> -->
                <div class="col-sm-7 text-right text-center-xs">                
                    <span>{!! $order->links() !!}</span>
                <!-- <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul> -->
                </div>
            </div>
        </footer>
        <div style="display: flex; justify-content: center; align-item: center;">
    </div>
    </div>
    </div>
@endsection