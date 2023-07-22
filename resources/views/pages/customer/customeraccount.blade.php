@extends('pages.customer.customerlayout')
@section('content')
<section><!--form-->
    <?php
        $message = Session::get('message');
        if ($message) {
            echo '<h4 style="width: 460px; text-align: center; margin-left: 210px;" class="alert alert-danger">'.$message.'</h4>';
            Session::put('message', null);
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-2">
                <div class="signup-form"><!--sign up form-->
                    <h2 style="text-align: center;">Cập Nhật Mật Khẩu</h2>
                    <form action="{{ URL::to('/accountchange/'.$account_info->customer_id) }}" method="post">
                        {{ csrf_field() }}
                        <label style="text-align: center; width: 455px;" for="">Mật Khẩu Cũ:</label>
                        <input style="text-align: center;" type="password" name="old_password" placeholder="******"/>
                        @if($errors->has('old_password'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
                                {{ $errors->first('old_password') }}
                            </label>								
                        @endif
                        <label  style="text-align: center; width: 455px;"for="">Mật Khẩu Mới:</label>
                        <input style="text-align: center;" type="password" name="new_password" placeholder="******"/>
                        @if($errors->has('new_password'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
                                {{ $errors->first('new_password') }}
                            </label>								
                        @endif
                        <label style="text-align: center; width: 455px;" for="">Nhập Lại Mật Khẩu Mới:</label>
                        <input style="text-align: center; margin-bottom: 15px;" type="password" name="password_confirmation" placeholder="******"/>
                        @if($errors->has('password_confirmation'))
                            <label style="width: 456px; height: 20px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
                                {{ $errors->first('password_confirmation') }}
                            </label>								
                        @endif
                        <button style="margin: auto;" type="submit" class="btn btn-default">Cập Nhật Mật Khẩu</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection