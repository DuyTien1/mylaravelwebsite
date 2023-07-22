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

class CommentController extends Controller
{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function listcomment () {
        $this->authlogin();
        $product_c = DB::table('product')
        ->get();

        $manager_product_c = view('admin.listcomment')->with('product_c', $product_c);
        return view('admin.layout')->with('admin.listcomment', $manager_product_c);
    }


    public function commentdetails ($product_id) {
        $this->authlogin();
        $comlist = DB::table('comment')
        ->join('customer', 'comment.customer_id', '=', 'customer.customer_id')
        ->where('product_id', $product_id)
        ->get();

        $comcount = $comlist->count();

        $manager_comlist = view('admin.commentdetails')->with('comlist', $comlist)->with('comcount', $comcount);
        return view('admin.layout')->with('admin.commentdetails', $manager_comlist);
    }


    public function deletecomment ($comment_id) {
        $this->authlogin();
        DB::table('comment')->where('comment_id', $comment_id)->delete();
        Session::put('message', 'Xóa Bình Luận Thành Công');

        return Redirect()->back();
    }
}
