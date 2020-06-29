@extends('layouts.master')
@section('cssCustom')
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
@endsection
@section('content')
    <div class="top-content">
        @if(isset($flash_massage))
            <div class="alert alert-success">
                <strong>{{$flash_massage}}</strong>
            </div>
        @endif
        <h2>Thêm Mới Đơn Hàng </h2>
    </div>
    <form class="photo-form" action="/HTTT_QuanLy/public/orders/add-new-order" method="POST">
        <div class="form-horizontal">
            <hr/>
            <div class="form-group">
                <label for="lastName" class="control-label">
                    Nhân Viên Tạo Đơn:
                </label>
                <div class="col-md-6">
                    <input name="employeeName" id="employeeName" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label class=" control-label" for="customerName">
                    Họ & Tên Khách Hàng:
                </label>
                <div class="col-md-6">
                    <input name="customerName" id="customerName" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">
                    Số Điện Thoại:
                </label>
                <div class="col-md-6">
                    <input name="phone" id="phone" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class=" control-label">
                    Địa Chỉ:
                </label>
                <div class="col-md-6">
                    <input name="address" id="address" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label for="order1" class=" control-label">Mặt Hàng : </label>
                <div class="col-md-6">
                    <input name="product" id="product" class="form-control"/>
                </div>
                <label for="quantity1" class=" control-label">Số Lượng : </label>
                <div class="col-md-6">
                    <input name="quantity" id="quantity" class="form-control"/>
                </div>
                <label for="price1" class=" control-label">Giá : </label>
                <div class="col-md-6">
                    <input name="price" id="price" class="form-control" placeholder="Giá/1 sách ... VNĐ"/>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-md-8 text-right">
                    <button type="submit"
                            class="btn btn-success">
                        Đặt Hàng <span class="glyphicon glyphicon-fast-forward"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
