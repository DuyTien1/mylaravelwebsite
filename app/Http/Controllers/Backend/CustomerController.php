<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CustomerController extends Controller
{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function listcustomer () {
        $this->authlogin();
        $customer = DB::table('customer')->orderBy('customer_id', 'desc')->get();
        return view('admin.listcustomer')->with('customer', $customer);
    }

    
}
