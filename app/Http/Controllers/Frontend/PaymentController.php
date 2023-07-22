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

class PaymentController extends Controller
{
    public function showpayment () {
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();   
        return view('pages.payment.payment')->with('category', $category)->with('brand', $brand);
    }

    public function order (Request $request) {

        if ($request->ismethod('post')) {
            $validator = Validator::make($request->all(), [
                'payment_option' => 'required',
        ],
        [
                'payment_option.required' => 'Vui Lòng Chọn Hình Thức Thanh Toán',
        ]
    );
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        } else {
            $content = Cart::content();
            $tongtien = 0;
            foreach ($content as $t_content) {
                $tongtien = $tongtien + $t_content->price;
            }
            // insert order 
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = Date('Y-m-d H-i-s');
                $order_data = array();
                $order_data['customer_id'] = Session::get('customer_id');
                $order_data['shipping_id'] = Session::get('shipping_id');
                $order_data['payment_id'] = $request->payment_option;
                $order_data['tongtien'] = $tongtien;
                $order_data['trangthai'] = '0';
                $order_data['created_at'] = $date;
                $order_id = DB::table('order')->insertGetId($order_data);

            // insert order details
            foreach ($content as $v_content) {
                $orderdetails_data['order_id'] = $order_id;
                $orderdetails_data['product_id'] = $v_content->id;
                $orderdetails_data['tensanpham'] = $v_content->name;
                $orderdetails_data['gia'] =$v_content->price;
                $orderdetails_data['soluong'] = $v_content->qty;
                $orderdetails_data['hinhsanpham'] = $v_content->options->images;
                DB::table('orderdetails')->insert($orderdetails_data);
                Session::put('shipping_id', null);
            }
            if ($order_data['payment_id']==1) {
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();  
                Cart::destroy();
                return View('pages.payment.transfer')->with('category', $category)->with('brand', $brand);
            }else if($order_data['payment_id']==2) {
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();  
                Cart::destroy();
                return View('pages.payment.handcash')->with('category', $category)->with('brand', $brand);
            }else if ($order_data['payment_id']==3){
                echo 'ghi no';
            }
        }
    }
    }
}
