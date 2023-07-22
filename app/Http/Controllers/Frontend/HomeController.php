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

class HomeController extends Controller
{
    public function index(Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();

        // $product = DB::table('product')
        // ->select('product.id', 'category_id', 'brand_id', 'tensanpham', 'hinhsanpham', 'gia', 'soluong', 'tendanhmuc', 'tenthuonghieu', 'mota')
        // ->join('category', 'category.id', '=', 'category_id')
        // ->join('brand', 'brand.id', '=', 'brand_id')
        // ->orderBy('id', 'desc')
        // ->get();
        $listproduct = DB::table('product')
        ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->select('product.*', 'brand.tenthuonghieu', 'category.tendanhmuc')
        ->orderby('product_id', 'desc')
        ->paginate(6);

        $viewproduct = DB::table('product')
        ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
        ->join('category', 'category.category_id', '=', 'product.category_id')
        ->select('product.*', 'brand.*', 'category.*')
        ->orderby('luotxem', 'desc')
        ->limit(3)
        ->get();

        return view('pages.home')->with('category', $category)->with('brand', $brand)->with(compact('listproduct'))->with('viewproduct', $viewproduct)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }

    public function searchproduct (Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal";
        $url = $request->url();
        $category = DB::table('category')->orderBy('category_id', 'desc')->get();
        $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();

        // $product = DB::table('product')
        // ->select('product.id', 'category_id', 'brand_id', 'tensanpham', 'hinhsanpham', 'gia', 'soluong', 'tendanhmuc', 'tenthuonghieu', 'mota')
        // ->join('category', 'category.id', '=', 'category_id')
        // ->join('brand', 'brand.id', '=', 'brand_id')
        // ->orderBy('id', 'desc')
        // ->get();
        $kw = $request->keywords;
        $search_result = DB::table('product')->where('tensanpham', 'like', '%'.$kw.'%')->get();

        return view('pages.product.searchproduct')->with('category', $category)->with('brand', $brand)->with('search_result', $search_result)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url);
    }


    public function homeaddcart ($product_id, Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal";
        $url = $request->url();

        $product_info = DB::table('product')->where('product_id', $product_id)->first();
        $soluongtrongkho = $product_info->soluong;


        if ($soluongtrongkho > 0) {
            $data['id'] = $product_info->product_id;
            $data['qty'] = '1';
            $data['name'] = $product_info->tensanpham;
            $data['price'] = $product_info->gia;
            $data['weight'] = '1';
            $data['options']['images'] = $product_info->hinhsanpham;
            Cart::add($data);
            Cart::setGlobalTax(0);
            $data_pro['soluong'] = $soluongtrongkho - 1;
            DB::table('product')->where('product_id', $product_id)->update($data_pro);
            Session::put('message', 'Thêm Sản Phẩm Vào Giỏ Hàng Thành Công Đến Trang Giỏ Hàng Để Xem Chi Tiết');
            return Redirect()->back();
        } else {

            Session::put('message_danger', 'Thêm Sản Phẩm Vào Giỏ Hàng Thất Bại Sản Phẩm Đã Hết Hàng');
            return Redirect()->back();
        }
    }

    public function addfavorite ($product_id, Request $request) {
        $customer_id = Session::get('customer_id');
        $data = array();
        $data['customer_id'] = $customer_id;
        $data['product_id'] = $product_id;
        DB::table('favorite')->insert($data);
        Session::put('message', 'Thêm Yêu Thích Thành Công Đến Trang Yêu Thích Để Xem Chi Tiết');
        return Redirect()->back();
    }

    public function filterproduct (Request $request) {
        $meta_desc = "E-Shop Real Shop nước hoa uy tín hàng đầu Việt Nam";
        $meta_kw = "nước hoa, e-shopreal, nước hoa uy tín, nước hoa chính hãng";
        $meta_title = "E-ShopReal Filter";
        $url = $request->url();

        $sort = $request->sort;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;

        if ($minprice == null && $maxprice == null) {
            if ($sort == 0) {
                return Redirect('/');
            } else if ($sort == 1) {
                $filtername = "GIÁ TĂNG DẦN";
                $filterproduct = DB::table('product')
                ->orderBy('gia', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 2) {
                $filtername = "GIÁ GIẢM DẦN";
                $filterproduct = DB::table('product')->orderBy('gia', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 3) {
                $filtername = "TÊN A->Z";
                $filterproduct = DB::table('product')->orderBy('tensanpham', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 4) {
                $filtername = "TÊN Z->A";
                $filterproduct = DB::table('product')->orderBy('tensanpham', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }

        } else if ($sort == 0) {
            if ($maxprice == null) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '>', $minprice)
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($minprice == null) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '<', $maxprice)
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->whereBetween('product.gia', [$minprice, $maxprice])
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }
        } else if ($minprice == null) {
            if ($sort == 1) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '<', $maxprice)
                ->orderBy('gia', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 2) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '<', $maxprice)
                ->orderBy('gia', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 3) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '<', $maxprice)
                ->orderBy('tensanpham', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 4) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '<', $maxprice)
                ->orderBy('tensanpham', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }
            
        }else if ($maxprice == null) {
            if ($sort == 1) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '>', $minprice)
                ->orderBy('gia', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 2) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '>', $minprice)
                ->orderBy('gia', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 3) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '>', $minprice)
                ->orderBy('tensanpham', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 4) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->where('product.gia', '>', $minprice)
                ->orderBy('tensanpham', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }      
        }else {
            if ($sort == 1) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->whereBetween('product.gia', [$minprice, $maxprice])
                ->orderBy('gia', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            } else if ($sort == 2) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->whereBetween('product.gia', [$minprice, $maxprice])
                ->orderBy('gia', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 3) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->whereBetween('product.gia', [$minprice, $maxprice])
                ->orderBy('tensanpham', 'asc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }else if ($sort == 4) {
                $filtername = "KẾT QUẢ LỌC";
                $filterproduct = DB::table('product')
                ->whereBetween('product.gia', [$minprice, $maxprice])
                ->orderBy('tensanpham', 'desc')
                ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->select('product.*', 'brand.*', 'category.*')
                ->paginate(6);
                $category = DB::table('category')->orderBy('category_id', 'desc')->get();
                $brand = DB::table('brand')->orderBy('brand_id', 'desc')->get();
                return view('pages.filter')->with(compact('filterproduct'))->with('brand', $brand)->with('category', $category)->with('meta_desc', $meta_desc)->with('meta_kw', $meta_kw)->with('meta_title', $meta_title)->with('url', $url)->with('filtername', $filtername);
            }      
        }
    }

    public function autocompleteajax (Request $request) {
        $data = $request->all();

        if ($data['query']) {
            $product = DB::table('product')->where('tensanpham', 'LIKE', '%' .$data['query']. '%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: relative;">';
            foreach($product as $key => $val) {
                $output .= '<li><a href="#">' .$val->tensanpham.'</a></li>';
            }

            $output .= '</ul>';
            echo $output;
            return response()->json($product);
        }
    }

}   