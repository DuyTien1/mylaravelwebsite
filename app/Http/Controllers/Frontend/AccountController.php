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

class AccountController extends Controller
{
    public function authlogin() {
        $id = Session::get('customer_id');
        if (!$id) {
            return Redirect::to('/')->send();
        }
    }

    public function account_info ($customer_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Thông Tin Người Dùng";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $customer_info = DB::table('customer')->where('customer_id', $customer_id)->get();
        return view('pages.customer.customerinfo')->with('customer_info', $customer_info)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function history ($customer_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Lịch Sử Mua Hàng";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $history = DB::table('order')
        ->join('customer', 'customer.customer_id', '=', 'order.customer_id')
        ->select('order.*', 'customer.hoten')
        ->where('order.customer_id', $customer_id)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('pages.customer.customerhistory')->with('history', $history)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function historydetails ($order_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Chi Tiết Lịch Sử Mua Hàng";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $historydetails = DB::table('orderdetails')
        ->where('orderdetails.order_id', $order_id)
        ->get();
        return view('pages.customer.historydetails')->with('historydetails', $historydetails)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function customerupdate ($customer_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Cập Nhật Thông Tin";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $customerupdate = DB::table('customer')
        ->where('customer_id', $customer_id)
        ->first();
        return view('pages.customer.customerupdate')->with('customerupdate', $customerupdate)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function customersave ($customer_id, Request $request) {
        $this->authlogin();
        if ($request->ismethod('post')) {
            $validator = Validator::make($request->all(), [
                'new_name' => 'required|min:1|max:30',
                'new_add' => 'required|max:1000',
                'new_phone' => 'required|max:10|alpha_num',
        ],
        [
                'new_name.required' => 'Họ Và Tên Không Được Để Trống',
                'new_name.max' => 'Họ Và Tên Không Được Quá 30 Kí Tự',
                'new_name.min' => 'Họ Và Tên Không Được Ít Hơn 1 Kí Tự',
                'new_add.required' => 'Đia Chỉ Không Được Để Trống',
                'new_add.max' => 'Đia Chỉ Không Được Quá 1000 Kí Tự',
                'new_phone.required' => 'Số Điện Thoại Không Được Để Trống',
                'new_phone.max' => 'Số Điện Thoại Không Được Ít Hơn 10 Kí Tự',
                'new_phone.alpha_num' => 'Số Điện Thoại Phải Là Chữ Số',
        ]
        );
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = array();
            $data['hoten'] = $request->new_name;
            $data['diachi'] = $request->new_add;
            $data['sodienthoai'] = $request->new_phone;
            $category = DB::table('category')->orderBy('category_id', 'desc')->get();
            $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
            DB::table('customer')
            ->where('customer_id', $customer_id)
            ->update($data);
            Session::put('message', 'Chỉnh Sửa Thông Tin Người Dùng Thành Công');
            return Redirect::to('/account-info');
            }
        }  
    }

    public function showinfo (Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Thông Tin Người Dùng";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $customer_info = DB::table('customer')->where('customer_id', Session::get('customer_id'))->get();
        return view('pages.customer.customerinfo')->with('customer_info', $customer_info)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function detailscancel ($order_id) {
        $this->authlogin();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $data = array();
        $data['trangthai'] = 2;
        DB::table('order')->where('order_id', $order_id)->update($data);
        $history = DB::table('order')
        ->join('customer', 'customer.customer_id', '=', 'order.customer_id')
        ->select('order.*', 'customer.hoten')
        ->where('order.customer_id', Session::get('customer_id'))
        ->get();
        Session::put('message', 'Hủy Đơn Đặt Hàng Thành Công');
        return view('pages.customer.customerhistory')->with('history', $history)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function account ($customer_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Cập Nhật Mật Khẩu";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $account_info = DB::table('customer')->where('customer_id', $customer_id)->first();
        return view('pages.customer.customeraccount')->with('account_info', $account_info)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function accountchange ($customer_id, Request $request) {
        $this->authlogin();
        $customer_acc = DB::table('customer')->where('customer_id', $customer_id)->first();
        $old_pass = md5($request->old_password);
        $new_pass = md5($request->new_password);
        $confirm_pass = md5($request->password_confirmation);
        if ($customer_acc->password == $old_pass) {
            if ($request->ismethod('post')) {
                $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'new_password' => 'required|min:4|max:30',
                    'password_confirmation' => 'required|min:4|max:30|same:new_password',
            ],
            [
                    'old_password.required' => 'Mật Khẩu Cũ Không Được Để Trống',
                    'new_password.max' => 'Mật Khẩu Mới Không Được Quá 30 Kí Tự',
                    'new_password.min' => 'Mật Khẩu Mới Không Được Ít Hơn 4 Kí Tự',
                    'new_password.required' => 'Mật Khẩu Mới Không Được Để Trống',
                    'password_confirmation.same' => 'Mật Khẩu Mới Và Mật Khẩu Nhập Lại Không Trùng Khớp',
                    'password_confirmation.required' => 'Mật Khẩu Nhập Lại Không Được Để Trống',
                    'password_confirmation.max' => 'Mật Khẩu Nhập Lại Không Được Quá 30 Kí Tự',
                    'password_confirmation.min' => 'Mật Khẩu Nhập Lại Không Được Ít Hơn 4 Kí Tự',
            ]
            );
            if ($validator->fails()) {
                return Redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = array();
                $data['password'] = md5($request->new_password);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                DB::table('customer')
                ->where('customer_id', $customer_id)
                ->update($data);
                Session::put('message', 'Chỉnh Sửa Mật Khẩu Thành Công');
                return Redirect::to('/account-info');
                }
            }
        }else {
            Session::put('message', 'Mật Khẩu Cũ Không  Chính Xác');
            return Redirect()->back();
        }
    }

    public function favorite ($customer_id, Request $request) {
        $this->authlogin();
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Yêu Thích";
        $url = $request->url();

        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $favorite_data = DB::table('favorite')
        ->join('product', 'product.product_id', '=', 'favorite.product_id')
        ->select('product.*', 'favorite.*')
        ->where('customer_id', $customer_id)
        ->get();
        return view('pages.customer.customerfavorite')->with('favorite_data', $favorite_data)->with('category', $category)->with('brand', $brand)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function deletefavorite ($product_id) {
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        DB::table('favorite')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa Sản Phẩm Yêu Thích Thành Công');
        return redirect()->back();
    }

    public function customercancel ($order_id) {
        $this->Authlogin();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = Date('Y-m-d H-i-s');
        $status = 2;
        $details = DB::table('orderdetails')->where('order_id', $order_id)->get();
        foreach ($details as $de) {
            $product_id = $de->product_id;
            $soluongchitiet = $de->soluong;
            $product_info = DB::table('product')->where('product_id', $product_id)->first();
            $soluongtrongkho = $product_info->soluong;
            $data_pro['soluong'] = $soluongchitiet + $soluongtrongkho;
            DB::table('product')->where('product_id', $product_id)->update($data_pro);
        }
        $data = array();
        $data['trangthai'] = $status;
        $data['updated_at'] = $date;
        DB::table('order')->where('order_id',$order_id)->update($data);
        Session::put('message', 'Hủy Đơn Hàng Thành Công');
        return Redirect()->back();
    }
}
