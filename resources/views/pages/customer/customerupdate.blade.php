@extends('pages.customer.customerlayout')
@section('content')
<section><!--form-->
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message', null);
            }
        ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-2">
                <div class="signup-form"><!--sign up form-->
                    <h2 style="text-align: center;">Cập Nhật Thông Tin Tài Khoản</h2>
                    <form action="{{ URL::to('/customersave/'.$customerupdate->customer_id) }}" method="post">
                        {{ csrf_field() }}
                        <label style="text-align: center; width: 455px;" for="">Tên Người Dùng</label>
                        <input style="text-align: center;" type="text" name="new_name" value="{{ $customerupdate->hoten }}"/>
                        @if($errors->has('new_name'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px;" class="alert alert-danger">
                                {{ $errors->first('new_name') }}
                            </label>								
                        @endif
                        <label style="text-align: center; width: 455px;" for="">Địa Chỉ</label>
                        <input style="text-align: center;" type="text" name="new_add" value="{{ $customerupdate->diachi }}"/>
                        @if($errors->has('new_add'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px;" class="alert alert-danger">
                                {{ $errors->first('new_add') }}
                            </label>								
                        @endif
                        <label style="text-align: center; width: 455px;" for="">Số Điện Thoại</label>
                        <input style="text-align: center; margin-bottom: 15px;" type="text" name="new_phone" value="{{ $customerupdate->sodienthoai }}"/>
                        @if($errors->has('new_phone'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px;" class="alert alert-danger">
                                {{ $errors->first('new_phone') }}
                            </label>								
                        @endif
                        <button style="margin: auto;" type="submit" class="btn btn-default">Cập Nhật Thông Tin</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection