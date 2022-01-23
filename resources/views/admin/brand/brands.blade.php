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
                <a href="{{ route('admin.brands') }}" class="nav-link active">
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
                        <a href="{{route('admin.orders')}}" class="nav-link">
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
                <a href="{{route('admin.coupons')}}" class="nav-link">
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
                        <h1 class="m-0">Nhà cung cấp</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Nhà cung cấp</li>
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
                                <h3 class="card-title">Thêm nhà cung cấp</h3>
                            </div>
                            <div class="card-body">
                                <form action="javascript:void(0);" id="f-add-brand" method="post"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Tên nhà cung cấp <span style="color: red;">(*)</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Ex: Sony">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="cbHide" id="cb-hide">
                                                <label for="cb-hide">
                                                    Ẩn mục này
                                                </label>
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
                                <h3 class="card-title">Nhà cung cấp</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl-brands" class="table table-bordered">
                                    <thead>
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày khởi tạo</th>
                                        <th>Tùy chọn</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày khởi tạo</th>
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
                    $("#tbl-brands").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        processing: false,
                        serverSide: true,
                        ajax: "{{ route('admin.brands') }}",
                        columns: [{
                                "data": "name"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": "date"
                            },
                            {
                                "data": "action"
                            }
                        ]
                    }).buttons().container().appendTo('#tbl-brands_wrapper .col-md-6:eq(0)');
                });
                $(document).ready(function() {
                    $('#btn-add').click(function(e) {
                        e.preventDefault();
                        var f = new FormData($('#f-add-brand')[0]);
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.add.brands') }}",
                            data: f,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.pass) {
                                    toastr.success(response.pass)
                                    $('#tbl-brands').DataTable().ajax.reload(null,
                                        false); // user paging is not reset on reload
                                    $('#f-add-brand')[0].reset();
                                } else if (response.fail) {
                                    toastr.error(response.fail)
                                }
                            }
                        });
                    });
                });

                function changeFunction(id, status) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.change-status.brands') }}",
                        data: {
                            id: id,
                            status: status
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.pass) {
                                toastr.success(response.pass)
                                $('#tbl-brands').DataTable().ajax.reload(null,
                                    false); // user paging is not reset on reload
                            } else if (response.fail) {
                                toastr.error(response.fail)
                            }
                        }
                    });
                }

                function deleteFunction(id) {
                    bootbox.confirm("Bạn có chắc chắn muốn xóa nhà cung cấp này?", function(result) {
                        if (result == true) {
                            $.ajax({
                                type: "post",
                                url: "{{ route('admin.delete.brands') }}",
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.pass) {
                                        toastr.success(response.pass)
                                        $('#tbl-brands').DataTable().ajax.reload(null,
                                            false); // user paging is not reset on reload
                                    } else if (response.fail) {
                                        toastr.error(response.fail)
                                    } else if (response.warning) {
                                        $(document).Toasts('create', {
                                            class: 'bg-warning',
                                            title: 'Cảnh báo!',
                                            body: response.warning
                                        })
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
