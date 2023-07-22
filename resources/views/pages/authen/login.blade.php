@extends('layout')
@section('content')
	<?php
        $message = Session::get('message');
		$message_danger = Session::get('message_danger');
        if ($message) {
            echo '<h4 style="width: 850px; text-align: center;" class="alert alert-success">'.$message.'</h4>';
            Session::put('message', null);
        }
		if ($message_danger) {
            echo '<h4 style="width: 850px; text-align: center;" class="alert alert-danger">'.$message_danger.'</h4>';
            Session::put('message_danger', null);
        }
    ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="login-form"><!--login form-->
						<h2 style="text-align: center;">Đăng Nhập Với Tài Khoản Của Bạn</h2>
						<form action="{{ URL::to('/customer-login') }}" method="post">
                            {{ csrf_field() }}
							<input type="text" name="cus_email" placeholder="Email"/>
							<input type="password" name="cus_password" placeholder="Mật Khẩu" />
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Lưu Đăng Nhập
							</span> -->
							<div style="width: 100%; display: flex; align-items: center; justify-content: center;">
								<button type="submit" class="btn btn-default">Đăng Nhập</button>
							</div>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 style="text-align: center;">Đăng Ký Tài Khoản Mới</h2>
						<form action="{{ URL::to('/customer-signup') }}" method="post">
							{{ csrf_field() }}
							<input type="text" name="cus_name" placeholder="Họ Tên"/>
								@if($errors->has('cus_name'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_name') }}
								</label>								
								@endif
							<input type="email" name="cus_email" placeholder="Email"/>
								@if($errors->has('cus_email'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_email') }}
								</label>								
								@endif
							<input type="text" name="cus_add" placeholder="Địa Chỉ"/>
								@if($errors->has('cus_add'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_add') }}
								</label>								
								@endif
							<input type="text" name="cus_phone" placeholder="Số Điện Thoại"/>
								@if($errors->has('cus_phone'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_phone') }}
								</label>								
								@endif
							<input type="password" name="cus_pass" placeholder="Mật Khẩu"/>
								@if($errors->has('cus_pass'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_pass') }}
								</label>								
								@endif
                            <input type="password" name="cus_repass" placeholder="Nhập Lại Mật Khẩu"/>
								@if($errors->has('cus_repass'))
								<label style="width: 360px; height: 15px; font-size: 10px; font-weight: bold; line-height: 1px; text-align: center;" class="alert alert-danger">
									{{ $errors->first('cus_repass') }}
								</label>								
								@endif
							<div style="width: 100%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
								<button type="submit" class="btn btn-default">Đăng Ký</button>
							</div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
@endsection