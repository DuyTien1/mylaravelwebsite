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
                Chỉnh Sửa Danh Mục Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                @foreach($category as $key => $edit_cate)
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/updatecategory/'.$edit_cate->category_id) }}" method="post">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="addcategory">Tên Danh Mục</label>
                        <input type="text" class="form-control" value="{{ $edit_cate->tendanhmuc }}" id="updatecategory" placeholder="Tên Danh Mục" name="category">                     
                    </div>
                        <button type="submit" class="btn btn-info" name="updatecategory">Chỉnh Sửa Danh Mục</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

@endsection