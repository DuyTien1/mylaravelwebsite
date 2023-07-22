<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function addbrand() {
        $this->Authlogin();
        return view('admin.addbrand');
    }

    public function listbrand () {
        $this->Authlogin();
        $brand = DB::table('brand')->paginate(5);
        $manager_brand = view('admin.listbrand')->with(compact('brand'));
        return view('admin.layout')->with('admin.listbrand', $manager_brand);
    }

    public function savebrand(Request $request) {
        $this->Authlogin();
        $data = array();
        $data['tenthuonghieu'] = $request->brandname;
        $data['motathuonghieu'] = $request->branddesc;
        DB::table('brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/addbrand');
    }

    public function editbrand ($id) {
        $this->Authlogin();
        $brand = DB::table('brand')->where('brand_id', $id)->get();
        $manager_brand = view('admin.editbrand')->with('brand', $brand);
        return view('admin.layout')->with('admin.editbrand', $manager_brand);
    }

    public function deletebrand($id) {
        $this->Authlogin();
        DB::table('brand')->where('brand_id',$id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/listbrand');
    }

    public function updatebrand(Request $request, $id) {
        $this->Authlogin();
        $data = array();
        $data['tenthuonghieu'] = $request->brandname;
        $data['motathuonghieu'] = $request->branddesc;
        DB::table('brand')->where('brand_id',$id)->update($data);
        Session::put('message', 'Chỉnh Sửa thương hiệu sản phẩm thành công');
        return Redirect::to('/listbrand');
    }
}
