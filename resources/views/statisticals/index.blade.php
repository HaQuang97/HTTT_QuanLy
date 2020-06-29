@extends('layouts.master')
@section('cssCustom')
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
@endsection
@section('content')
    <div class="container">
        <h2>THỐNG KÊ</h2><br><br>

        <form class="photo-form" action="/HTTT_QuanLy/public/statisticals/statistical-date/" method="GET">
            {{ csrf_field() }}
            <label>Ngày Bắt Đầu</label>
            <input type="text" placeholder="YYYY-MM-DD" id="startDate" name="startDate" style="width: 20%">
            <label>Ngày Kết Thúc</label>
            <input type="text" placeholder="YYYY-MM-DD" id="endDate" name="endDate" style="width: 20%">
            <button type="submit" class="btn btn-info">Thống Kê</button>
        </form>
        <br><br>
        <p style="color: green">
            <b>SỐ LƯỢNG NHÂN VIÊN : {{$countEmployee}} </b><br>
            <b>SỐ LƯỢNG KHÁCH HÀNG : {{$countCustomer}} </b><br>
            <b>SỐ LƯỢNG ĐƠN HÀNG : {{$countOrder}}</b><br>
        </p>

    </div>
@endsection
