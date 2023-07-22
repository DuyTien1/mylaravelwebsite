<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function index(){
        return view('admin.login');
    }
    
    public function dashboard() {
        $this -> Authlogin();
        $admin_id = Session::get('admin_id');
        $admin_info = DB::table('admin')->where('admin_id', $admin_id)->first();
        $admin_name = $admin_info->hoten;   
        
        return view('admin.dashboard')->with('admin_name', $admin_name);
    }

    public function login (Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('admin')->where('email', $admin_email)->where('password', $admin_password)->first();
        if($result){
            Session::put('admin_hoten', $result->hoten);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('dashboard');
        }else{
            Session::put('message', 'Sai email hoặc mật khẩu vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
    }

    public function logout () {
        $this -> Authlogin();
        Session::put('admin_hoten', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
