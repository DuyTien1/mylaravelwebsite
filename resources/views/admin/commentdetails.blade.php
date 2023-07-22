@extends('admin.layout')
@section('admin_content')
    <div class="table-agile-info">
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<p class="text-alert">'.$message.'</p>';
                Session::put('message', null);
            }
            ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi Tiết Bình Luận
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
                <th>Người Bình Luận</th>
                <th>Nội Dung</th>
                <th style="width: 30px;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($comlist as $key => $lc)
            <tr>
                <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
                <td>{{ $lc -> hoten }}</td>
                <td>{{ $lc->noidung }}</td>
                <td>           
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')" href="{{ URL::to('/deletecomment/'.$lc->comment_id) }}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text-active"></i>
                </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <!-- <footer class="panel-footer">
            <div class="row">
                
                <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">                
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
                </div>
            </div>
        </footer> -->
        <div style="display: flex; align-item: center; justify-content: center;">
        <div>
            <a href="{{ URL::to('/listcomment') }}" type="submit" class="btn btn-info padding-right" name="addproduct">Trở Về</a>
        </div>
    </div>
</div>
</div>
</div>
@endsection