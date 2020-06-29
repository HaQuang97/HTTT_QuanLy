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
        <h2>DANH SÁCH SẢN PHẨM </h2>
        <h5><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">THÊM MỚI DỮ LIỆU</button></h5>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">THÊM MỚI DỮ LIỆU</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="photo-form" action="/HTTT_QuanLy/public/books/add-new-book" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                                <label for="fname">Tên Sách </label>
                                <input type="text" id="fname" name="txtBookName" placeholder="Tên ...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">ẢNH BÌA SÁCH </label>
                            <input type="file" id="image" name="image" class="form-control"/>
                        </div>
                        <div class="modal-body">
                            <label for="fname">Mô Tả </label>
                            <input type="text" id="fname" name="txtDescriptionBook" placeholder="Mô tả ...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Giá </label>
                            <input type="number" id="fname" name="txtPriceBook" placeholder="Giá ... VNĐ"> VNĐ
                        </div>
                        <div class="modal-body">
                            <label for="fname">Nhà Xuất Bản </label>
                            <input type="text" id="fname" name="txtSupplierBook" placeholder="Nhà xuất bản ...">
                        </div>
                        <div class="modal-body">
                            <label for="fname">Trạng Thái</label>
                            <select id="fname" name="txtStatusBook">
                                <option value="0">Trạng Thái</option>
                                <option value="1" style="background-color: green">Còn Hàng</option>
                                <option value="2" style="background-color: #f50017">Hết Hàng</option>
                            </select>
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
            <th>TÊN SÁCH</th>
            <th>IMAGE</th>
            <th>MÔ TẢ</th>
            <th>GIÁ</th>
            <th>NHÀ XUẤT BẢN</th>
            <th>TRẠNG THÁI</th>
            <th>THAO TÁC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $value){ ?>
            <tr>
                <td><?php echo $value['id']?></td>
                <td><?php echo $value['name']?></td>
                <td><?php echo $value['image']?></td>
                <td><?php echo $value['description']?></td>
                <td><?php echo $value['price']?></td>
                <td><?php echo $value['supplier']?></td>
                <td>
                    @if($value['status'] == 1)
                        <p>Còn Hàng</p>
                    @elseif($value['status'] == 2)
                        <p>Hết Hàng</p>
                    @endif
                </td>
                <td>
{{--ACTION--EDIT--}}
                    <div class="modal fade modalEditClass" id="modalEdit{{$value['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold text-secondary ml-5">Sửa Chi Nhánh</h4>
                                    <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="photo-form" action="/HTTT_QuanLy/public/books/update-book/{{$value['id']}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">TÊN SÁCH</label>
                                            <input type="text" id="txtBookName" name="txtBookName" class="form-control validate" value="{{$value['name']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">MÔ TẢ</label>
                                            <input type="text" id="txtDescriptionBook" name="txtDescriptionBook" class="form-control validate" value="{{$value['description']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">GIÁ</label>
                                            <input type="text" id="txtPriceBook" name="txtPriceBook" class="form-control validate" value="{{$value['price']}}"> VNĐ
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">NHÀ XUẤT BẢN</label>
                                            <input type="text" id="txtSupplierBook" name="txtSupplierBook" class="form-control validate" value="{{$value['supplier']}}">
                                        </div>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form mb-5">
                                            <label data-error="wrong" data-success="right" for="formNameEdit">TRẠNG THÁI</label>

                                            @if ($value['status'] == 1)
                                                <select id="fname" name="txtStatusBook">
                                                    <option value="1" style="background-color: green">Còn Hàng</option>
                                                    <option value="2" style="background-color: #f50017">Hết Hàng
                                                    </option>
                                                </select>
                                            @elseif($value['status'] == 2)
                                                <select id="fname" name="txtStatusBook">
                                                    <option value="2" style="background-color: #f50017">Hết Hàng
                                                    </option>
                                                    <option value="1" style="background-color: green">Còn Hàng</option>
                                                </select>
                                            @endif
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
                                <form action="/HTTT_QuanLy/public/books/delete-book/{{$value['id']}}" method="POST">
                                    @csrf
                                    <div class="modal-body mx-3">
                                        <p class="text-center h4">Bạn có muốn xóa {{$value['name']}} không?</p>

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
