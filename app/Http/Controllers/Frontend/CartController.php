<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class CartController extends Controller
{
    public function savecart(Request $request) {   
        $product_id = $request->product_id_hidden;       
        $quantity = $request->qty;
        $product_info = DB::table('product')->where('product_id', $product_id)->first();
        $soluong = $product_info->soluong;
        $soluongconlai = $soluong - $quantity;

        if ($soluongconlai < 0 ) {
            $data_pro['soluong'] = $soluong;
            DB::table('product')->where('product_id', $product_id)->update($data_pro);
            Session::put('message_danger', 'Số Lượng Mua Vượt Mức Kho');
            return Redirect()->back();
        } else {
            $data_pro['soluong'] = $soluongconlai;
            DB::table('product')->where('product_id', $product_id)->update($data_pro);
            $data['id'] = $product_id;
            $data['qty'] = $quantity;
            $data['name'] = $product_info->tensanpham;
            $data['price'] = $product_info->gia;
            $data['weight'] = '1';
            $data['options']['images'] = $product_info->hinhsanpham;
            Cart::add($data);
            Cart::setGlobalTax(0);
            Session::put('message', 'Thêm Sản Phẩm Vào Giỏ Hàng Thành Công Đến Trang Giỏ Hàng Để Xem Chi Tiết');
            return Redirect()->back();
        }
    }
    
    public function showcart() {       
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();   
        return view('pages.cart.listcart')->with('category', $category)->with('brand', $brand);
    }

    public function deletecart(Request $request) {
        $rowId = $request->rowId_cart;
        $product_id = $request->product_id;
        $incart_qty = $request->incart_qty;

        $product_info = DB::table('product')->where('product_id', $product_id)->first();

        $soluongtrongkho = $product_info->soluong;
        $soluongcapnhat = $soluongtrongkho + $incart_qty;
        $data['soluong'] = $soluongcapnhat;

        DB::table('product')->where('product_id', $product_id)->update($data);

        Cart::update($rowId,0);

        $cart = Cart::count();
        if ($cart == null ) {
            return Redirect::to('/');
        } else {
            Session::put('message', 'Xóa Sản Phẩm Trong Giỏ Hàng Thành Công');
            return Redirect()->back();
        }
    }
    
    public function updatecartqty (Request $request) {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_qty;
        $product_id = $request->product_id;
        $cart_qty = $request->incart_qty;
        
        $product_info = DB::table('product')->where('product_id', $product_id)->first();
        
        $soluongkho = $product_info->soluong;
        $soluongthucte = $soluongkho + $cart_qty;
        $soluongcapnhat = $soluongthucte - $qty;
        
        if ($soluongcapnhat < 0) {
            $data['soluong'] = $soluongkho;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Session::put('message_danger', 'Số Lượng Mua Vượt Mức Kho');
            return Redirect()->back();
        } else {
            $data['soluong'] = $soluongcapnhat;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Cart::update($rowId,$qty);
            return Redirect()->back();
        }
    }
}

