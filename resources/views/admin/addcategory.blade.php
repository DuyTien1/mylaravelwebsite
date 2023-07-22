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
                Thêm Danh Mục Sản Phẩm
                <br>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/savecategory') }}" method="post">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="addcategory">Tên Danh Mục</label>
                        <input type="text" class="form-control" id="addcategory" placeholder="Tên Danh Mục" name="category">
                    </div>
                    <div style="display: flex; align-item: center; justify-content: center;">
                        <button type="submit" class="btn btn-info" name="addcategory">Thêm Danh Mục</button>
                    </div>  
                </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection