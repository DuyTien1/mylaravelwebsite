<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function addproduct() {
        $this->authlogin();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        return view('admin.addproduct')->with('category', $category)->with('brand', $brand);
    }

    public function listproduct () {
        $this->authlogin();
        $product = DB::table('product')
        // ->select('product.id', 'category_id', 'brand_id', 'tensanpham', 'hinhsanpham', 'gia', 'soluong', 'tendanhmuc', 'tenthuonghieu', 'mota')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
        ->orderBy('product.product_id', 'desc')
        ->get();
        $manager_product = view('admin.listproduct')->with('product', $product);
        return view('admin.layout')->with('admin.listproduct', $manager_product);
    }

    public function saveproduct(Request $request) {
        $this->authlogin();
        $data = array();
        $data['tensanpham'] = $request->productname;
        $data['gia'] = $request->productprize;
        $data['soluong'] = $request->productamount;
        $data['mota'] = $request->productdesc;
        $data['category_id'] = $request->productcate;
        $data['brand_id'] = $request->productbr;
        $data['soluongban'] = $request->productsell;
        $data['luotxem'] = $request->productview;
        $getimage = $request->file('productimage');

        if ($getimage) {
            $getnameimage = $getimage->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $newimage = $nameimage.rand(0, 199).'.'.$getimage->getClientOriginalExtension();
            $getimage -> move('uploads/product', $newimage);
            $data['hinhsanpham'] = $newimage;
            DB::table('product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('/addproduct');
        }
        $data['hinhsanpham'] = '';
        DB::table('product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('/addproduct');
    }

    public function editproduct ($id) {
        $this->authlogin();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
        $product = DB::table('product')->where('product_id', $id)->get();
        $manager_product = view('admin.editproduct')->with('product', $product)->with('category', $category)->with('brand', $brand);
        return view('admin.layout')->with('admin.editproduct', $manager_product);
    }

    public function deleteproduct($id) {
        $this->authlogin();
        DB::table('product')->where('product_id',$id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/listproduct');
    }

    public function updateproduct(Request $request, $id) {
        $this->authlogin();
        $data = array();
        $data['tensanpham'] = $request->productname;
        $data['gia'] = $request->productprize;
        $data['soluong'] = $request->productamount;
        $data['mota'] = $request->productdesc;
        $data['category_id'] = $request->productcate;
        $data['brand_id'] = $request->productbr;
        $getimage = $request->file('productimage');

        if ($getimage) {
            $getnameimage = $getimage->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $newimage = $nameimage.rand(0, 199).'.'.$getimage->getClientOriginalExtension();
            $getimage -> move('uploads/product', $newimage);
            $data['hinhsanpham'] = $newimage;
            DB::table('product')->where('product_id', $id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/listproduct');
        }
        DB::table('product')->where('product_id', $id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/listproduct');
    }
}
