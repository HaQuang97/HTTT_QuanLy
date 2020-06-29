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
        <h2>DANH SÁCH CHI NHÁNH </h2>
        <h5><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">THÊM MỚI DỮ LIỆU</button></h5>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">THÊM MỚI DỮ LIỆU</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="photo-form" action="/HTTT_QuanLy/public/employees/add-new-employee" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                                <label for="fname">Tên Nhân Viên</label>
                                <input required type="text" id="fname" name="txtEmployeeName" placeholder="Name employee...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Email</label>
                            <input required type="text" id="fname" name="txtEmail" placeholder="Email...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Địa Chỉ</label>
                            <input type="text" id="fname" name="txtAddressEmployee" placeholder="Address employee...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Role</label>
                            <input required type="text" id="fname" name="txtRole" placeholder="Role...">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>MÃ CN</th>
            <th>TÊN NHÂN VIÊN</th>
            <th>ĐỊA CHỈ</th>
            <th>EMAIL</th>
            <th>CHỨC VỤ</th>
            <th>CHI NHÁNH</th>
            <th>THAO TÁC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $value){ ?>
            <tr>
                <td><?php echo $value['id']?></td>
                <td><?php echo $value['branch_code']?></td>
                <td><?php echo $value['name']?></td>
                <td><?php echo $value['address']?></td>
                <td><?php echo $value['email']?></td>
                <td><?php echo $value['role']?></td>
                <td>
                    @if($value['branch_code']=="HN")
                        {{'CN Tp.Hà Nội'}}
                    @elseif($value['branch_code']=="HCM")
                            {{'CN Tp.Hồ Chí Minh '}}
                    @endif
                </td>
                <td>
{{--ACTION--EDIT--}}
                    <div class="modal fade modalEditClass" id="modalEdit{{$value['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold text-secondary ml-5">Sửa Nhân Viên</h4>
                                    <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="photo-form" action="/HTTT_QuanLy/public/employees/update-employee/{{$value['id']}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">TÊN NHÂN VIÊN </label>
                                            <input type="text" id="txtEmployeeName" name="txtEmployeeName" class="form-control validate" value="{{$value['name']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">ĐỊA CHỈ</label>
                                            <input type="text" id="txtAddressEmployee" name="txtAddressEmployee" class="form-control validate" value="{{$value['address']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">EMAIL </label>
                                            <input type="text" id="txtEmail" name="txtEmail" class="form-control validate" value="{{$value['email']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">CHỨC VỤ </label>
                                            <input type="text" id="txtRole" name="txtRole" class="form-control validate" value="{{$value['role']}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{$value['id']}}">SỬA</button>
{{--END--EDIT--}}
{{--ACTION--DELETE--}}
                    <div class="modal fade" id="modalDelete{{$value['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalDelete"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold ml-5 text-danger">Delete</h4>
                                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/HTTT_QuanLy/public/employees/delete-employee/{{$value['id']}}" method="POST">
                                    @csrf
                                    <div class="modal-body mx-3">
                                        <p class="text-center h4">Bạn có muốn xóa nhân viên {{$value['name']}} không?</p>

                                    </div>
                                    <div class="modal-footer d-flex justify-content-center deleteButtonsWrapper">
                                        <input type="submit" class="btn btn-danger" value="Đồng Ý">
                                        <button type="button" class="btn btn-primary btnNoClass" id="btnNo" data-dismiss="modal">Không Xóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete{{$value['id']}}">DELETE</button>
{{--END--DELETE--}}
                </td>
            </tr>
        <?php } ?>
    </table>
    {{$data->links()}}
@endsection
