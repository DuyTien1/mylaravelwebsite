<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
session_start();

class StatisticalController extends Controller
{
    public function authlogin() {
        $id = Session::get('admin_id');
        if ($id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }

    public function dailystatis (Request $request) {

        $date = $request->statistical;

        $statis = DB::table('statistical')->where('created_at', $date)->first();
        $check = DB::table('order')->whereDate('created_at', $date)->where('trangthai', 1)->get();
        if ($check){
            if (!$statis) {
                $order = DB::table('order')->whereDate('created_at', $date)->where('trangthai', 1)->get();
                $tonggiatri = 0;
                $tongsoluong = 0;
                $tongdonhang = 0;
                foreach ($order as $key => $val) {
                    $order_id = $val->order_id;
                    $orderdetails = DB::table('orderdetails')->where('order_id', $order_id)->get();
                    foreach($orderdetails as $key => $val2) {
                        $x = $val2->gia * $val2->soluong;
                        $tonggiatri = $tonggiatri + $x;
                        $tongsoluong = $tongsoluong + $val2->soluong;
                    }
                    $tongdonhang = $tongdonhang + 1;
                } 
                $data = array();
                $data['tonggiatri'] = $tonggiatri;
                $data['tongsoluong'] = $tongsoluong;
                $data['tongdonhang'] = $tongdonhang;
                $data['created_at'] = $date;
                DB::table('statistical')->insert($data);
                Session::put('message', 'Thống Kê Hàng Ngày Thành Công');
                return Redirect()->back();
            } else {
                Session::put('message_danger', 'Hôm Nay Đã Thống Kê Rồi');
                return Redirect()->back();
            }
        }else{
            if (!$statis) {
                $data = array();
                $data['tonggiatri'] = 0;
                $data['tongsoluong'] = 0;
                $data['tongdonhang'] = 0;
                $data['created_at'] = $date;
                DB::table('statistical')->insert($data);
                Session::put('message', 'Thống Kê Hàng Ngày Thành Công');
                return Redirect()->back();
            }else {
                Session::put('message_danger', 'Hôm Nay Đã Thống Kê Rồi');
                return Redirect()->back();
            }
        }
        
    }

    public function filter_by_date (Request $request) {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = DB::table('statistical')->whereBetween('created_at', [$from_date, $to_date])->orderBy('created_at', 'ASC')->get();

        foreach($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->created_at,
                'tonggiatri' => $val->tonggiatri,
                'tongsoluong' => $val->tongsoluong,
                'tongdonhang' => $val->tongdonhang
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter (Request $request) {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $tru7ngay = $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $tru365ngay = $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $baygio = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_filter_value'] == '7ngay') {
            $get = DB::table('statistical')->whereBetween('created_at', [$tru7ngay, $baygio])->orderBy('created_at', 'ASC')->get();
        } else if ($data['dashboard_filter_value'] == 'thangtruoc') {
            $get = DB::table('statistical')->whereBetween('created_at', [$dauthangtruoc, $cuoithangtruoc])->orderBy('created_at', 'ASC')->get();
        } else if ($data['dashboard_filter_value'] == 'thangnay') {
            $get = DB::table('statistical')->whereBetween('created_at', [$dauthangnay, $baygio])->orderBy('created_at', 'ASC')->get();
        } else if ($data['dashboard_filter_value'] == '365ngay') {
            $get = DB::table('statistical')->whereBetween('created_at', [$tru365ngay, $baygio])->orderBy('created_at', 'ASC')->get();
        }

        foreach($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->created_at,
                'tonggiatri' => $val->tonggiatri,
                'tongsoluong' => $val->tongsoluong,
                'tongdonhang' => $val->tongdonhang
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function autodisplay (Request $request) {
        $data = $request->all();
        $tru7ngay = $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $baygio = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = DB::table('statistical')->whereBetween('created_at', [$tru7ngay, $baygio])->orderBy('created_at', 'ASC')->get();

        foreach($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->created_at,
                'tonggiatri' => $val->tonggiatri,
                'tongsoluong' => $val->tongsoluong,
                'tongdonhang' => $val->tongdonhang
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function statistical () {
        $this->authlogin();
        $manager_product = view('admin.statistical');
        return view('admin.layout')->with('admin.statistical', $manager_product);
    }
}
