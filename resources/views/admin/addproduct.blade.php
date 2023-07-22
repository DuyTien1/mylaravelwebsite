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
                Thêm Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/saveproduct') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tên Sản Phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" class="form-control" name="productname">
                        </div>
                        <div class="form-group">
                            <label for="">Giá Sản Phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" class="form-control" name="productprize">
                        </div>  
                        <div class="form-group">
                            <label for="">Số Lượng Sản Phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" class="form-control" name="productamount">
                        </div>
                        <div class="form-group">
                            <label for="">Hình Sản Phẩm</label>
                            <input type="file" data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" class="form-control" name="productimage">
                        </div>
                        <div class="form-group">
                            <label for="">Mô Tả Sản Phẩm</label>
                            <textarea data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" style="resize: none;" rows="8" class="form-control" name="productdesc" id="ckeditor"></textarea>
                        </div>  
                        <div class="form-group">
                            <label for="">Chọn Danh Mục</label>
                            <select name="productcate" id="" class="form-control input-sm m-bot15">
                                @foreach($category as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->tendanhmuc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Thương Hiệu</label>
                            <select name="productbr" id="" class="form-control input-sm m-bot15">
                                @foreach($brand as $key => $br)
                                        <option value="{{ $br->brand_id }}">{{ $br->tenthuonghieu }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div>
                            <input type="hidden" name="productsell" value="0"></input>
                        </div>  
                        <div>
                            <input type="hidden" name="productview" value="0"></input>
                        </div>
                        <div style="display: flex; align-item: center; justify-content: center;">
                            <button type="submit" class="btn btn-info" name="addproduct">Thêm Sản Phẩm</button>
                        </div>                              
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection