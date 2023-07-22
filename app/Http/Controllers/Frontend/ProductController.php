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

class ProductController extends Controller
{
    public function listcategory () {
        return view('pages.category.listcategory');
    }
    
    public function productdetail ($id, Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Trang Chi Tiết Sản Phẩm";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();

        $product_view = DB::table('product')->where('product_id', $id)->first();
        $view = $product_view->luotxem;
        $view_update = $view + 1;
        $data_view['luotxem'] = $view_update;
        DB::table('product')->where('product_id', $id)->update($data_view);

        $productdetail = DB::table('product')
        // ->select('product.id', 'category_id', 'brand_id', 'tensanpham', 'hinhsanpham', 'gia', 'soluong', 'tendanhmuc', 'mota', 'tenthuonghieu')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
        ->where('product.product_id', $id)
        ->get();
        
        foreach($productdetail as $key => $value) {
            $category_id = $value->category_id;
        }

        $offerproduct = DB::table('product')
        // ->select('product.id', 'category_id', 'brand_id', 'tensanpham', 'hinhsanpham', 'gia', 'soluong', 'tendanhmuc', 'mota', 'tenthuonghieu')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
        ->where('category.category_id', $category_id)
        ->whereNotIn('product.product_id', [$id])
        ->limit(3)
        ->get();

        
        $customer_id = Session::get('customer_id');
        $pro_id = $id;
        $damua = 0;
        $comments = DB::table('comment')
        ->join('customer', 'customer.customer_id', '=', 'comment.customer_id')
        ->where('comment.product_id', $pro_id)
        ->select('comment.*', 'customer.hoten')
        ->limit(6)
        ->orderBy('created_at', 'desc')
        ->get();
        $order_buy = DB::table('order')->where('customer_id', $customer_id)->where('trangthai', 1)->get();
        if ($order_buy) {
            foreach ($order_buy as $ob) {
                $buy = DB::table('orderdetails')->where('order_id', $ob->order_id)->get();
                foreach($buy as $b) {
                    if ($b->product_id == $pro_id) {
                        $damua = $damua + 1;
                    }
                }
            }
            return view('pages.product.productdetail')->with('category', $category)->with('brand', $brand)->with('productdetail', $productdetail)->with('offerproduct', $offerproduct)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('comments', $comments)->with('damua', $damua);
        } else {
            return view('pages.product.productdetail')->with('category', $category)->with('brand', $brand)->with('productdetail', $productdetail)->with('offerproduct', $offerproduct)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('comments', $comments);
        }
    }

    public function addcomment (Request $request) {
        if ($request->ismethod('post')) {
            $validator = Validator::make($request->all(), [
                'comment' => 'required',
        ],
        [
                'comment.required' => 'Vui Lòng Điền Nội Dung Trước Khi Bình Luận',
        ]
    ); 
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput();
        } else {
            $product_id = $request->pro_id;
            $customer_id = Session::get('customer_id');
            $comment = $request->comment;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = Date('Y-m-d H-i-s');
    
            $data = array();
            $data['customer_id'] = $customer_id;
            $data['product_id'] = $product_id;
            $data['noidung'] = $comment;
            $data['created_at'] = $date;
    
            DB::table('comment')->insert($data);
            Session::put('message', 'Thêm Bình Luận Thành Công');
            return Redirect()->back();
        }
    }
    }
    public function deletecomment ($comment_id) {
        DB::table('comment')->where('comment_id', $comment_id)->delete();
        Session::put('message', 'Xóa Bình Luận Thành Công');
        return Redirect()->back();
    }
}
