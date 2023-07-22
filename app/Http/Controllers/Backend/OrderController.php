<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class OrderController extends Controller
{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function listorder() {
        $this->authlogin();
        $order = DB::table('order')
        ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
        ->select('order.*', 'customer.hoten')
        ->orderBy('order.order_id', 'desc')
        ->paginate(10);
        $manager_order = view('admin.listorder')->with(compact('order'));

        return view('admin.layout')->with('admin.listorder', $manager_order);
    }

    public function showorderdetails($orderId) {
        $this->authlogin();
        $orderdetails = DB::table('order')
        ->join('orderdetails', 'order.order_id', '=', 'orderdetails.order_id')
        ->join('product', 'product.product_id', '=', 'orderdetails.product_id')
        ->select('order.*', 'orderdetails.*')
        ->where('order.order_id', $orderId)
        ->orderBy('order.order_id', 'desc')
        ->get();

        $ordershipping = DB::table('order')
        ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
        ->select('order.*', 'shipping.*')
        ->where('order.order_id', $orderId)
        ->orderBy('order.order_id', 'desc')
        ->first();

        $order = DB::table('order')->where('order_id', $orderId)->first();
        $p_id = $order->payment_id;
        $payment = DB::table('payment')->where('payment_id', $p_id)->first();
        $hinhthuc = $payment->hinhthuc;
        $tongtien = $order->tongtien;
        $trangthai = $order->trangthai;
        
        $manager_orderdetails = view('admin.orderdetails')->with('orderdetails', $orderdetails)->with('ordershipping', $ordershipping)->with('tongtien', $tongtien)->with('trangthai', $trangthai)->with('hinhthuc', $hinhthuc);
        return view('admin.layout')->with('admin.orderdetails', $manager_orderdetails);
    }

    public function confirm ($order_id) {
        $this->Authlogin();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = Date('Y-m-d H-i-s');
        $status = 1;
        $data = array();
        $data['trangthai'] = $status;
        $data['updated_at'] = $date;
        DB::table('order')->where('order_id',$order_id)->update($data);

        $order = DB::table('order')->where('order_id', $order_id)->first();
        $odetails = DB::table('orderdetails')->where('order_id', $order->order_id)->get();
        foreach ($odetails as $key => $val) {
            $p_id = $val->product_id;
            $ban = $val->soluong;
            $p = DB::table('product')->where('product_id', $p_id)->first();
            $soluongtrong = $p->soluongban;
            $tong = $ban + $soluongtrong;
            $s['soluongban'] = $tong;
            DB::table('product')->where('product_id', $p_id)->update($s);           
        }

        Session::put('message', 'Xác Nhận Đơn Hàng Thành Công');
        return Redirect::to('/listorder');
    }

    public function cancel ($order_id) {
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
        return Redirect::to('/listorder');
    }

    public function deleteorder ($order_id) {
        $this->Authlogin();
        DB::table('order')->where('order_id', $order_id)->delete();
        Session::put('message', 'Xóa Đơn Hàng Thành Công');
        return Redirect::to('/listorder');
    }
}
