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
        <h2>DANH SÁCH ĐƠN HÀNG </h2>
            <h5><button type="button" class="btn btn-primary" ><a href="/HTTT_QuanLy/public/orders/get-order">THÊM MỚI DỮ LIỆU</a></button></h5>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>MÃ NHÂN VIÊN</th>
            <th>MÃ KHÁCH HÀNG</th>
            <th>MÃ CN</th>
            <th>THANH TOÁN</th>
            <th>NGÀY TẠO</th>
            <th>NGÀY CẬP NHẬT</th>
            <th>THAO TÁC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $value){ ?>
        <tr>
            <td><?php echo $value['id']?></td>
            <td><?php echo $value['employee_id']?></td>
            <td><?php echo $value['customer_id']?></td>
            <td><?php echo $value['branch_code']?></td>
            <td><?php echo $value['total_price']?> VND</td>
            <td><?php echo $value['created_at']?></td>
            <td><?php echo $value['updated_at']?></td>
            <td>
                <button type="button" class="btn btn-primary">
                    <a href="/HTTT_QuanLy/public/orders/order-detail/{{$value['id']}}" >Chi Tiết</a><br>
                </button>
                <button type="button" class="btn btn-warning">
                    <a href="/HTTT_QuanLy/public/orders/update-order/{{$value['id']}}" class="btn-warning">Sửa</a><br>
                </button>
                <button type="button" class="btn btn-danger">
                    <a href="/HTTT_QuanLy/public/orders/delete-order/{{$value['id']}}" class="btn-danger">Xóa</a>
                </button>
            </td>
        </tr>
        <?php } ?>
    </table>
    {{$data->links()}}
@endsection
