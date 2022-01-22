@extends('admin.layout-layers-2')
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
                        <a href="{{ route('admin.products.statistical') }}" class="nav-link">
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
                <form action="" id="f-add-product" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-block mb-3">Quay lại danh
                                sách
                                đơn hàng</a>
                            <div class="card">
                                <div class="card-body">
                                    @foreach ($details as $item)
                                        <div class="form-group">
                                            @if ($item->total > 1500000)
                                                <span><b>Phí vận chuyển:</b> 0 VND</span>
                                            @else
                                                <span><b>Phí vận chuyển:</b> 30.000 VND</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <span><b>Giảm giá:</b> {{ $item->coupons }}%</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Tổng tiền đơn hàng:</b>
                                                {{ App\Helper\Helpers::currencyFormat($item->total) }}</span>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <span><b>Tên khách hàng:</b> {{ $item->user_name }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>SĐT:</b> {{ $item->user_phone }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Email:</b> {{ $item->user_email }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span><b>Địa chỉ:</b> {{ $item->street }}, {{ $item->district }},
                                                {{ $item->provice }}</span>
                                        </div>
                                    @break
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <label for="desc">Chi tiết đơn hàng</label>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Tên sản phẩm</th>
                                            <th style="width: 100px;">Hình ảnh</th>
                                            <th>Giá</th>
                                            <th>Số lượng mua</th>
                                            <th>Số lượng hàng tồn kho</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <div class="filtr-item" data-category="1"
                                                            data-sort="white sample">
                                                            <a href="../../storage/app/public/images/{{ $item->avatar }}"
                                                                data-toggle="lightbox" data-title="{{ $item->avatar }}">
                                                                <img src="../../storage/app/public/images/{{ $item->avatar }}"
                                                                    class="img-fluid mb-2" alt="white sample" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>{{ App\Helper\Helpers::currencyFormat($item->price) }}</td>
                                                    <td>{{ $item->orders_qty }}</td>
                                                    <td>{{ $item->product_qty - $item->product_qty_sold }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="margin-top: 15px;">
                                        @switch($details[0]->status)
                                            @case($details[0]->status == 1)
                                                <span><b>Tình trạng đơn hàng: </b>Đang chờ xác nhận</span>
                                                <hr>
                                                <button type="button" id="btn-confirm" class="btn btn-primary btn-sm">Xác nhận
                                                    đơn
                                                    hàng</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#modal-default">Hủy đơn hàng</button>
                                            @break
                                            @case($details[0]->status == 2)
                                                <span><b>Tình trạng đơn hàng: </b>Đang vận chuyển</span>
                                                <hr>
                                                <button type="button" id="btn-delivered" class="btn btn-success btn-sm">Đã giao
                                                    hàng</button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#modal-default">Hủy đơn hàng</button>
                                            @break
                                            @case($details[0]->status == 3)
                                                <span><b>Tình trạng đơn hàng: </b>Đã giao hàng</span>
                                            @break
                                            @case($details[0]->status == 4)
                                                <span><b>Tình trạng đơn hàng: </b>Đã hủy</span>
                                                <hr>
                                                <button type="button" id="btn-confirm" class="btn btn-primary btn-sm">Xác nhận
                                                    đơn
                                                    hàng</button>
                                            @break
                                            @default

                                        @endswitch
                                        <input type="hidden" id="hd-code" value="{{ request()->route('code') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hủy đơn hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reason">Lý do</label>
                            <textarea type="text" style="width: 100%; height: 150px;" name="reason" id="reason"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
                        <button id="btn-cancel" type="button" class="btn btn-danger">Hủy đơn hàng</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <script>
        $(document).on('click', '#btn-confirm', function() {
            var code = $('#hd-code').val();
            $.ajax({
                type: "post",
                url: "{{ route('admin.confirm-order') }}",
                data: {
                    code: code
                },
                dataType: "json",
                success: function(response) {
                    window.location.href = "{{ route('admin.orders') }}";
                }
            });
        });
        $(document).on('click', '#btn-delivered', function() {
            var code = $('#hd-code').val();
            $.ajax({
                type: "post",
                url: "{{ route('admin.delivered') }}",
                data: {
                    code: code
                },
                dataType: "json",
                success: function(response) {
                    window.location.href = "{{ route('admin.orders') }}";
                }
            });
        });
        $(document).on('click', '#btn-cancel', function() {
            var code = $('#hd-code').val(),
                reason = $('#reason').val();
            $.ajax({
                type: "post",
                url: "{{ route('admin.cancel-order') }}",
                data: {
                    code: code,
                    reason: reason
                },
                dataType: "json",
                success: function(response) {
                    window.location.href = "{{ route('admin.orders') }}";
                }
            });
        });
    </script>
@endsection
