<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
    public function listcategory ($id, Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal - Danh Mục";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();

        $listproduct = DB::table('product')
        ->join('brand', 'product.brand_id', '=', 'brand.brand_id')
        ->join('category', 'product.category_id', '=', 'category.category_id')
        ->select('product.*', 'brand.tenthuonghieu', 'category.tendanhmuc')
        ->where('product.category_id', $id)
        ->get();

        $catename = DB::table('category')->where('category_id', $id)->limit(1)->get();

        return view('pages.category.listcategory')->with('category', $category)->with('brand', $brand)->with('listproduct', $listproduct)->with('categoryname', $catename)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }
}
