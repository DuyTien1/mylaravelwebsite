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
                Liệt Kê Sản Phẩm
                <br>
                </div>
                <!-- <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control w-sm inline v-middle">
                            <option value="0">Bulk action</option>
                            <option value="1">Delete selected</option>
                            <option value="2">Bulk edit</option>
                            <option value="3">Export</option>
                        </select>
                        <button class="btn btn-sm btn-default">Apply</button>                
                    </div>
                </div> -->
        <!-- <div class="col-sm-3">
            <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
            </div>
        </div> -->
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
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>
                <th>Thương Hiệu</th>
                <th>Hình</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Mô Tả</th>
                <th style="width:30px;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($product as $key => $pro)
            <tr>
                <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
                <td>{{ $pro -> tensanpham }}</td>
                <td>{{ $pro -> tendanhmuc }}</td>
                <td>{{ $pro -> tenthuonghieu }}</td>
                <td><img src="uploads/product/{{ $pro -> hinhsanpham }}" alt="" heigh="100" width="100"></td>
                <td>{{ $pro -> gia }}</td>
                <td>{{ $pro -> soluong }}</td>
                <td>{{ $pro -> mota }}</td>
                <td>
                <a href="{{ URL::to('/editproduct/'.$pro->product_id) }}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="{{ URL::to('/deleteproduct/'.$pro->product_id) }}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
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
    </div>
    </div>
@endsection