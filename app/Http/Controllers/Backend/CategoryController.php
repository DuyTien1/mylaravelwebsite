<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function addcategory() {
        $this->authlogin();
        return view('admin.addcategory');
    }

    public function listcategory () {
        $this->authlogin();
        $category = DB::table('category')->get();
        $manager_category = view('admin.listcategory')->with('category', $category);
        return view('admin.layout')->with('admin.listcategory', $manager_category);
    }

    public function savecategory(Request $request) {
        $this->authlogin();
        $data = array();
        $data['tendanhmuc'] = $request->category;
        DB::table('category')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/addcategory');
    }

    public function editcategory ($id) {
        $this->authlogin();
        $category = DB::table('category')->where('category_id', $id)->get();
        $manager_category = view('admin.editcategory')->with('category', $category);
        return view('admin.layout')->with('admin.editcategory', $manager_category);
    }

    public function deletecategory($id) {
        $this->authlogin();
        DB::table('category')->where('category_id',$id)->delete();
        Session::put('message', 'Xóa sửa danh mục sản phẩm thành công');
        return Redirect::to('/listcategory');
    }

    public function updatecategory(Request $request, $id) {
        $this->authlogin();
        $data = array();
        $data['tendanhmuc'] = $request->category;
        DB::table('category')->where('category_id',$id)->update($data);
        Session::put('message', 'Chỉnh Sửa danh mục sản phẩm thành công');
        return Redirect::to('/listcategory');
    }
}
