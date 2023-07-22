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
                Chỉnh Sửa Thương Hiệu Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                @foreach($brand as $key => $edit_br)
                <div class="position-center">
                    <form role="form" action="{{ URL::to('updatebrand/'.$edit_br->brand_id) }}" method="post">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="addbrand">Tên Thương Hiệu</label>
                        <input data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" type="text" class="form-control" value="{{ $edit_br->tenthuonghieu }}" id="updatebrand" placeholder="Tên Thương Hiệu" name="brandname">
                    </div>  
                    <div class="form-group">
                        <label for="ckeditorbr">Mô Tả Thương Hiệu</label>
                        <textarea data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" style="resize: none;" rows="8" class="form-control" name="branddesc" id="ckeditorbr">{{ $edit_br->motathuonghieu }}</textarea>
                    </div>                               
                    <button type="submit" class="btn btn-info" name="updatebrand">Chỉnh Sửa Thương Hiệu</button>
                </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

@endsection