@extends('admin.layout')
@section('admin_content')
<div class="col-sm-12" style="display: flex; justify-content: center; align-item: center;">
    <h2>Thống Kê</h2>
    <br>
    <br>
</div>
<div class="col-sm-12" style="display: flex; justify-content: center; align-item: center;">
    <?php
        $message = Session::get('message');
        $message_danger = Session::get('message_danger');
        if ($message) {
            echo '<p style="margin-bottom: 20px; font-size: 20px;" class="text-success">'.$message.'</p>';
            Session::put('message', null);
        }
        if ($message_danger) {
            echo '<p style="margin-bottom: 20px; font-size: 20px;" class="text-alert">'.$message_danger.'</p>';
            Session::put('message_danger', null);
        }
    ?>
</div>
<br>
<div class="col-sm-12">
    <form autocomplete="off" action="{{ URL::to('/dailystatis') }}" method="post" style="display: flex; justify-content: center; align-item: center; margin: 10px 0 10px 0;">
            @csrf
            <div class="col-sm-2" >
                <p style="text-align: center; font-weight: bold;">Chọn Ngày Thống Kê<input name="statistical" class="dashboard-filter form-control" type="text" id="datepicker3"></p>
            </div>
            <div class="col-sm-2">
                <p style="text-align: center; font-weight: bold;">
                    <input style="margin-top: 21px;" type="submit" id="btn-dashboard-filter" class="btn btn-success btn-dashboard-filter form-control" value="Thống Kê">
                </p>
            </div>
    </from>
</div>
@endsection