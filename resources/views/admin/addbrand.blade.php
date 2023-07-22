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
                Thêm Thương Hiệu Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/savebrand') }}" method="post">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="addbrandname">Tên Thương Hiệu</label>
                        <input data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" type="text" class="form-control" id="addbrandname" placeholder="Tên Danh Mục" name="brandname">
                    </div>  
                    <div class="form-group">
                        <label for="ckeditorbr">Mô Tả Thương Hiệu</label>
                        <textarea data-validation="length" data-validation-length="min1" data-validation-error-msg="Hãy điền thông tin vào trường này!" style="resize: none;" rows="8" class="form-control" name="branddesc" id="ckeditorbr"></textarea>
                    </div> 
                    <div style="display: flex; align-item: center; justify-content: center;">
                        <button style="margin: auto;" type="submit" class="btn btn-info" name="addbrand">Thêm Thương Hiệu</button>
                    </div>                         
                </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection