<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
session_start();

class CheckoutController extends Controller
{
    public function logincheckout() {
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();   

        return view('pages.checkout.logincheckout')->with('category', $category)->with('brand', $brand);
    }

    public function customersignup (Request $request) {
        $data = array();
        $data['hoten'] = $request->cus_name;
        $data['diachi'] = $request->cus_add;
        $data['email'] = $request->cus_email;
        $data['sodienthoai'] = $request->cus_phone;
        $data['password'] = md5($request->cus_name);

        $customer_id = DB::table('customer')->insertGetId($data);

        session::put('customer_id', $customer_id);
        session::put('customer_name', $request->cus_name);
        Session::put('message', 'Đăng Ký Tài Khoản Mới Thành Công Hãy Đăng Nhập Ngay!');

        return Redirect::to('/checkout');
    }

    public function checkout($customer_id) {
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get(); 
        $cart = Cart::count();
        if ($cart == null ) {
            Session::put('message_danger', 'Giỏ Hàng Rỗng Hãy Mua Một Món Hàng Ngay Nào');
            return Redirect::to('/');
        } else {
            $data_customer = DB::table('customer')->where('customer_id', $customer_id)->first();
            return view('pages.checkout.showcheckout')->with('data_customer', $data_customer)->with('category', $category)->with('brand', $brand);
        }
    }
    
    public function savecheckout (Request $request) {

        if ($request->ismethod('post')) {
            $validator = Validator::make($request->all(), [
                'shipping_name' => 'required|min:1|max:30',
                'shipping_email' => 'required|email',
                'shipping_add' => 'required|min:1|max:1000',
                'shipping_phone' => 'required|min:10|alpha_num',
                'shipping_note' => 'required|max:1000',
        ],
        [
                'shipping_name.required' => 'Họ Và Tên Người Đặt Hàng Không Được Để Trống',
                'shipping_name.max' => 'Họ Và Tên Người Đặt Hàng Không Được Quá 30 Kí Tự',
                'shipping_name.min' => 'Họ Và Tên Người Đặt Hàng Không Được Ít Hơn 1 Kí Tự',
                'shipping_name.regex' => 'Họ Và Tên Người Đặt Hàng Không Được Chứa Chữ Số',
                'shipping_email.required' => 'Email Không Được Để Trống',
                'shipping_add.required' => 'Đia Chỉ Không Được Để Trống',
                'shipping_add.min' => 'Đia Chỉ Không Được Ít Hơn 1 Kí Tự',
                'shipping_add.max' => 'Đia Chỉ Không Được Quá 1000 Kí Tự',
                'shipping_phone.required' => 'Số Điện Thoại Không Được Để Trống',
                'shipping_phone.min' => 'Số Điện Thoại Không Được Ít Hơn 10 Kí Tự',
                'shipping_phone.alpha_num' => 'Số Điện Thoại Phải Là Chữ Số',
                'shipping_note.required' => 'Ghi Chú Không Được Để Trống',
                'shipping_note.max' => 'Ghi Chú Không Được Quá 100 Kí Tự',
        ]
    );
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        } else {
            $category = DB::table('category')->orderBy('category_id', 'desc')->get();
            $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get(); 
            $customer_id = Session::get('customer_id');
            $data = array();
            $data['customer_id'] = $customer_id;
            $data['hoten'] = $request->shipping_name;
            $data['email'] = $request->shipping_email;
            $data['diachi'] = $request->shipping_add;
            $data['sodienthoai'] = $request->shipping_phone;
            $data['ghichu'] = $request->shipping_note;
            $shipping_id = DB::table('shipping')->insertGetId($data);
            session::put('shipping_id', $shipping_id);
            return Redirect::to('/payment')->with('category', $category)->with('brand', $brand);
            }
        }  
    }
}
