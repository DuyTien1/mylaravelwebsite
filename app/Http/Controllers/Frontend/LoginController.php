<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
session_start();

class LoginController extends Controller
{
    public function customersignup (Request $request) {

        $email = $request->cus_email;
        $sdt = $request->cus_phone;
        $customer_sdt = DB::table('customer')->where('sodienthoai', $sdt)->first();
        $customer_email = DB::table('customer')->where('email', $email)->first();

        if (!$customer_email && !$customer_sdt) {
            if ($request->ismethod('post')) {
                $validator = Validator::make($request->all(), [
                    'cus_name' => 'required|min:1|max:50',
                    'cus_email' => 'required|email',
                    'cus_add' => 'required|min:4|max:1000',
                    'cus_phone' => 'required|max:10|alpha_num',
                    'cus_pass' => 'required|min:4|max:30',
                    'cus_repass' => 'required|min:4|max:30|same:cus_pass',
            ],
            [
                    'cus_name.required' => 'Họ Và Tên Không Được Để Trống',
                    'cus_name.max' => 'Họ Và Tên Không Được Quá 50 Kí Tự',
                    'cus_name.min' => 'Họ Và Tên Không Được Ít Hơn 1 Kí Tự',
                    'cus_email.email' => 'Định Dạng Email Không Đúng',
                    'cus_email.required' => 'Email Không Được Để Trống',
                    'cus_add.required' => 'Đia Chỉ Không Được Để Trống',
                    'cus_add.min' => 'Địa Chỉ Không Được Ít Hơn 4 Kí Tự',
                    'cus_add.max' => 'Địa Chỉ Không Được Quá 1000 Kí Tự',
                    'cus_phone.required' => 'Số Điện Thoại Không Được Để Trống',
                    'cus_phone.max' => 'Số Điện Thoại Không Được Quá 10 Chữ Số',
                    'cus_phone.alpha_num' => 'Số Điện Thoại Phải Là Chữ Số',
                    'cus_pass.required' => 'Mật Khẩu Không Được Để Trống',
                    'cus_pass.min' => 'Mật Khẩu Không Được Ít Hơn 4 Kí Tự',
                    'cus_pass.max' => 'Mật Khẩu Không Được Quá 30 Kí Tự',
                    'cus_repass.required' => 'Mật Khẩu Nhập Lại Không Được Để Trống',
                    'cus_repass.min' => 'Mật Khẩu Nhập Lại Không Được Ít Hơn 4 Kí Tự',
                    'cus_repass.max' => 'Mật Khẩu Nhập Lại Không Được Quá 30 Kí Tự',
                    'cus_repass.same' => 'Mật Khẩu Nhập Lại Chưa Khớp Với Mật Khẩu',
            ]
            );
            if ($validator->fails()) {
                return Redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = array();
                $data['hoten'] = $request->cus_name;
                $data['diachi'] = $request->cus_add;
                $data['email'] = $request->cus_email;
                $data['sodienthoai'] = $request->cus_phone;
                $data['password'] = md5($request->cus_pass);
        
                $customer_id = DB::table('customer')->insertGetId($data);
            
                Session::put('message', 'Đăng Ký Tài Khoản Mới Thành Công Hãy Đăng Nhập Ngay!');
        
                return Redirect::to('/checklogin');
                }
            } 
        } else if ($customer_email) {
            Session::put('message_danger', 'Email đã tồn tại, Vui Lòng chọn email khác!');
            return Redirect::to('/checklogin');
        } else if ($customer_sdt) {
            Session::put('message_danger', 'Số điện thoại đã tồn tại, Vui lòng chọn  số điện thoại khác!');
            return Redirect::to('/checklogin');
        }
}

    public function customerlogin (Request $request) {

        $email = $request->cus_email;
        $pass = md5($request->cus_password);
        
        $customer = DB::table('customer')->where('email', $email)->where('password', $pass)->first();
        
        if ($customer) {
            session::put('customer_id', $customer->customer_id);
            session::put('customer_name', $customer->hoten);
            return Redirect::to('/');
        }else {
            Session::put('message_danger', 'Đăng Nhập Thất Bại! Sai Email Hoặc Mật Khẩu');
            return Redirect::to('/checklogin');
        }
}

    public function checklogin (Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Đăng Nhập";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();  

        return View('pages.authen.login')->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function customerlogout () {
        Session::flush();
        return Redirect::to('/');
    }
}
