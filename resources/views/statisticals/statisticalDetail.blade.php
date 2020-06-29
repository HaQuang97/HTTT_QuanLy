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
        <br>
        <p><b>Danh Sách Đơn Hàng</b></p>
        <?php $total = 0;?>
        <?php foreach($listOrder as $value){ ?>
            <?php $total = $total + $value->total_price; ?>
        <?php }?>
        <p>
            SỐ LƯỢNG ĐƠN HÀNG : {{count($listOrder)}}<br>
            TỔNG DOANH THU : {{$total}} VND
        </p>
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
            <?php foreach($listOrder as $value){ ?>
            <tr>
                <td><?php echo $value->id?></td>
                <td><?php echo $value->employee_id;?></td>
                <td><?php echo $value->customer_id;?></td>
                <td><?php echo $value->branch_code;?></td>
                <td><?php echo $value->total_price;?> VND</td>
                <td><?php echo $value->created_at;?></td>
                <td><?php echo $value->updated_at;?></td>
                <td>
                    <button type="button" class="btn btn-primary">
                        <a href="/HTTT_QuanLy/public/orders/order-detail/{{$value->id}}" >Chi Tiết</a><br>
                    </button>
                    <button type="button" class="btn btn-warning">
                        <a href="/HTTT_QuanLy/public/orders/update-order/{{$value->id}}" class="btn-warning">Sửa</a><br>
                    </button>
                    <button type="button" class="btn btn-danger">
                        <a href="/HTTT_QuanLy/public/orders/delete-order/{{$value->id}}" class="btn-danger">Xóa</a>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br><br>
        <p><b>Danh Sách Khách Hàng Mới</b></p>
        SỐ LƯỢNG KHÁCH MỚI : {{count($listCustomer)}}
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>MÃ CN</th>
                <th>TÊN KHÁCH HÀNG</th>
                <th>ĐỊA CHỈ</th>
                <th>SỐ ĐIỆN THOẠI </th>
                <th>THAO TÁC</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($listCustomer as $data){ ?>

            <tr>
                <td><?php echo $data->id;?></td>
                <td><?php echo $data->branch_code;?></td>
                <td><?php echo $data->name;?></td>
                <td><?php echo $data->address;?></td>
                <td><?php echo $data->phone;?></td>
                <td>
                    {{--ACTION--EDIT--}}
                    <div class="modal fade modalEditClass" id="modalEdit{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold text-secondary ml-5">Sửa Thông Tin Khách Hàng</h4>
                                    <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="photo-form" action="/HTTT_QuanLy/public/customers/update-customer/{{$data->id}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">TÊN KHÁCH HÀNG </label>
                                            <input type="text" id="txtCustomerName" name="txtCustomerName" class="form-control validate" value="{{$data->name}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">ĐỊA CHỈ</label>
                                            <input type="text" id="txtAddressCustomer" name="txtAddressCustomer" class="form-control validate" value="{{$data->address}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">SỐ ĐIỆN THOẠI </label>
                                            <input type="text" id="txtPhoneCustomer" name="txtPhoneCustomer" class="form-control validate" value="{{$data->phone}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{$data->id}}">SỬA</button>
                    {{--END--EDIT--}}
                    {{--ACTION--DELETE--}}
                    <div class="modal fade" id="modalDelete{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDelete"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold ml-5 text-danger">Delete</h4>
                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/HTTT_QuanLy/public/customers/delete-customer/{{$data->id}}" method="POST">
                                    @csrf
                                    <div class="modal-body mx-3">
                                        <p class="text-center h4">Bạn có muốn xóa khách hàng {{$data->name}} không?</p>

                                    </div>
                                    <div class="modal-footer d-flex justify-content-center deleteButtonsWrapper">
                                        <input type="submit" class="btn btn-danger" value="Đồng Ý">
                                        <button type="button" class="btn btn-primary btnNoClass" id="btnNo" data-dismiss="modal">Không Xóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete{{$data->id}}">DELETE</button>
                    {{--END--DELETE--}}
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
@endsection
