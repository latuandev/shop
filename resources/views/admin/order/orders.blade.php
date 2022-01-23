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
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-cart-arrow-down"></i>
                <p>
                    Đơn hàng
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.orders') }}" class="nav-link active">
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
            <a href="{{ route('admin.coupons') }}" class="nav-link">
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
                    <h1 class="m-0">Sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header" style="display: flex; align-items: center;">
                    <h3 class="card-title mr-3">Danh sách đơn hàng</h3>
                </div>
                <div class="card-body">
                    <table id="tbl-orders" class="table table-bordered">
                        <thead>
                            <th>Mã đơn hàng</th>
                            <th>Tên người dùng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <th>Mã đơn hàng</th>
                            <th>Tên người dùng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                //
                $("#tbl-orders").DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    processing: false,
                    serverSide: true,
                    ajax: "{{ route('admin.orders') }}",
                    columns: [{
                            "data": "code",
                        },
                        {
                            "data": "user_name"
                        },
                        {
                            "data": "total"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "option"
                        }
                    ]
                }).buttons().container().appendTo('#tbl-orders_wrapper .col-md-6:eq(0)');
            });
        </script>
    </section>
</div>
@endsection
