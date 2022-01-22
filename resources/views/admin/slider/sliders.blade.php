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
                <a href="{{ route('admin.sliders') }}" class="nav-link active">
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
                        <a href="{{ route('admin.products.statistical') }}" class="nav-link">
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
                        <a href="{{ route('admin.orders.ship') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vận chuyển</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.statistical') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thống kê</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.coupons') }}" class="nav-link">
                    <i class="nav-icon fas fa-bookmark"></i>
                    <p class="text">Mã giảm giá</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link">
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
                        <h1 class="m-0">Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header" style="display: flex; align-items: center;">
                        <h3 class="card-title mr-3">Danh sách sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <table id="tbl-products" class="table table-bordered">
                            <thead>
                                <th>Tên</th>
                                <th style="width: 150px;">Ảnh đại diện</th>
                                <th>Mã</th>
                                <th>Hãng</th>
                                <th>Tùy chọn</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th>Tên</th>
                                <th style="width: 150px;">Ảnh đại diện</th>
                                <th>Mã</th>
                                <th>Hãng</th>
                                <th>Tùy chọn</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    //
                    $("#tbl-products").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        processing: false,
                        serverSide: true,
                        ajax: "{{ route('admin.sliders') }}",
                        columns: [{
                                "data": "name",
                            },
                            {
                                "data": "avatar"
                            },
                            {
                                "data": "code"
                            },
                            {
                                "data": "brand"
                            },
                            {
                                "data": "action"
                            }
                        ]
                    }).buttons().container().appendTo('#tbl-products_wrapper .col-md-6:eq(0)');
                });
                //
                function addSliders(id) {
                    $.ajax({
                        type: "post",
                        url: "{{route('admin.add.sliders')}}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.pass) {
                                toastr.success(response.pass)
                                $('#tbl-products').DataTable().ajax.reload(null, false);
                            } else if (response.fail) {
                                toastr.error(response.fail)
                            }
                        }
                    });
                }
                //
                function deleteSliders(id) {
                    $.ajax({
                        type: "post",
                        url: "{{route('admin.delete.sliders')}}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.pass) {
                                toastr.success(response.pass)
                                $('#tbl-products').DataTable().ajax.reload(null, false);
                            } else if (response.fail) {
                                toastr.error(response.fail)
                            }
                        }
                    });
                }
            </script>
        </section>
    </div>
@endsection
