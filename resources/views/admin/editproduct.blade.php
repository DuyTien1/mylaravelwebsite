@extends('admin.layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<p class="text-alert">'.$message.'</p>';
                Session::put('message', null);
            }
        ?>
        <section class="panel">
            <header class="panel-heading">
                Chỉnh Sửa Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @foreach($product as $key => $pro)
                    <form role="form" action="{{ URL::to('/updateproduct/'.$pro->product_id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" value="{{ $pro->tensanpham }}" name="productname">
                    </div>
                    <div class="form-group">
                        <label for="">Giá Sản Phẩm</label>
                        <input type="text" class="form-control" value="{{ $pro->gia }}" name="productprize">
                    </div>  
                    <div class="form-group">
                        <label for="">Số Lượng Sản Phẩm</label>
                        <input type="text" class="form-control" value="{{ $pro->soluong }}" name="productamount">
                    </div>
                    <div class="form-group">
                        <label for="">Hình Sản Phẩm</label>
                        <input type="file" class="form-control"  name="productimage">
                        <img src="{{ URL::to('uploads/product/'.$pro -> hinhsanpham) }}" alt="" heigh="100" width="100">
                    </div>
                    <div class="form-group">
                        <label for="">Mô Tả Sản Phẩm</label>
                        <textarea style="resize: none;" rows="8" class="form-control" name="productdesc">{{ $pro->mota }}</textarea>
                    </div>  
                    <div class="form-group">
                        <label for="">Chọn Danh Mục</label>
                        <select name="productcate" id="" class="form-control input-sm m-bot15">
                            @foreach($category as $key => $cate)
                                @if($cate->category_id == $pro->category_id)
                                    <option selected value="{{ $cate->category_id }}">{{ $cate->tendanhmuc }}</option>
                                @else
                                    <option value="{{ $cate->category_id }}">{{ $cate->tendanhmuc }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn Thương Hiệu</label>
                        <select name="productbr" id="" class="form-control input-sm m-bot15">
                            @foreach($brand as $key => $br)
                                @if($br->brand_id == $pro->brand_id)
                                    <option selected value="{{ $br->brand_id }}">{{ $br->tenthuonghieu }}</option>
                                @else
                                    <option value="{{ $br->brand_id }}">{{ $br->tenthuonghieu }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>                           
                    <button type="submit" class="btn btn-info" name="addproduct">Chỉnh Sửa Sản Phẩm</button>
                </form>
                @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection