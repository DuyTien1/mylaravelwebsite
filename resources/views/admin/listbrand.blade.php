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
            Liệt Kê Thương Hiệu Sản Phẩm
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
            <th style="width: 150px;">Tên Thương Hiệu</th>
            <th style="text-align: center;">Mô Tả Thương Hiệu</th>
            <th style="width:30px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($brand as $key => $br)
        <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $br -> tenthuonghieu }}</td>
            <td>{{ $br -> motathuonghieu }}</td>
            <td>
            <a href="{{ URL::to('/editbrand/'.$br->brand_id) }}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>
            <a onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')" href="{{ URL::to('/deletebrand/'.$br->brand_id) }}" class="active styling-edit" ui-toggle-class="">
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
    <div style="display: flex; justify-content: center; align-item: center;">
        <span>{!! $brand->links() !!}</span>
    </div>
</div>
@endsection