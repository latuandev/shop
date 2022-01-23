@extends('admin.layout-layers-1')
@section('menu')
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                                        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="text">Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sliders') }}" class="nav-link">
                <i class="nav-icon fab fa-slideshare"></i>
                <p class="text">Slider</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.brands') }}" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p class="text">Nhà cung cấp</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories') }}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p class="text">Chuyên mục</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fab fa-product-hunt"></i>
                <p>
                    Sản phẩm
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.products') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh sách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" onclick="updatingFunction()">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cart-arrow-down"></i>
                <p>
                    Đơn hàng
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.orders') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh sách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" onclick="updatingFunction()">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vận chuyển</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" onclick="updatingFunction()">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Thống kê</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.coupons') }}" class="nav-link active">
                <i class="nav-icon fas fa-bookmark"></i>
                <p class="text">Mã giảm giá</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link" onclick="updatingFunction()">
                <i class="nav-icon fas fa-users"></i>
                <p class="text">Người dùng</p>
            </a>
        </li>
    </ul>
</nav>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mã giảm giá</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mã giảm giá</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm mã giảm giá</h3>
                        </div>
                        <div class="card-body">
                            <form action="javascript:void(0);" id="f-add-coupons" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Tên mã giảm giá <span style="color: red;">(*)</span></label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Ex: Giảm giá dịp Tết nguyên đán">
                                </div>
                                <div class="form-group">
                                    <label for="name">% giảm <span style="color: red;">(*)</span></label>
                                    <input type="text" id="offer" name="offer" class="form-control"
                                        placeholder="Ex: 15 | Max: 100">
                                </div>
                                <div class="form-group">
                                    <label>Hạn dùng:</label>
                                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input type="text" name="expiry" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" placeholder="Ngày-tháng-năm"/>
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                                <button type="button" id="btn-add" class="btn btn-primary btn-sm">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Mã giảm giá</h3>
                        </div>
                        <div class="card-body">
                            <table id="tbl-coupons" class="table table-bordered">
                                <thead>
                                    <th>Tên</th>
                                    <th>Mã</th>
                                    <th>% giảm</th>
                                    <th>Hạng dùng</th>
                                    <th>Tùy chọn</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Tên</th>
                                    <th>Mã</th>
                                    <th>% giảm</th>
                                    <th>Hạng dùng</th>
                                    <th>Tùy chọn</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $("#tbl-coupons").DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    processing: false,
                    serverSide: true,
                    ajax: "{{ route('admin.coupons') }}",
                    columns: [{
                            "data": "name"
                        },
                        {
                            "data": "code"
                        },
                        {
                            "data": "offer"
                        },
                        {
                            "data": "expiry"
                        },
                        {
                            "data": "action"
                        }
                    ]
                }).buttons().container().appendTo('#tbl-coupons_wrapper .col-md-6:eq(0)');
            });
            $(document).ready(function() {
                $('#btn-add').click(function(e) {
                    e.preventDefault();
                    var f = new FormData($('#f-add-coupons')[0]);
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.add.coupons') }}",
                        data: f,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.pass) {
                                toastr.success(response.pass)
                                $('#tbl-coupons').DataTable().ajax.reload(null,
                                    false); // user paging is not reset on reload
                                $('#f-add-coupons')[0].reset();
                            } else if (response.fail) {
                                toastr.error(response.fail)
                            }
                        }
                    });
                });
            });

            function deleteFunction(id) {
                bootbox.confirm("Bạn có chắc chắn muốn xóa mã giảm giá này?", function(result) {
                    if (result == true) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.delete.coupons') }}",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.pass) {
                                    toastr.success(response.pass)
                                    $('#tbl-coupons').DataTable().ajax.reload(null,
                                        false); // user paging is not reset on reload
                                } else if (response.fail) {
                                    toastr.error(response.fail)
                                }
                            }
                        });
                    }
                })
            }
        </script>
    </section>
</div>
@endsection
