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
                <a href="{{route('admin.sliders')}}" class="nav-link">
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
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>
                        Sản phẩm
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.products') }}" class="nav-link active">
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
                        <div class="col-md-5">
                            <a href="{{ route('admin.products') }}" class="btn btn-primary btn-block mb-3">Quay lại danh sách
                                sản phẩm</a>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm <span style="color: red;">(*)</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Ex: Bộ chuyển đổi chơi game bằng chuột, bàn phím cho máy PS4,Xbox One, Nintendo Switch Aturos MK-1 (Tặng kèm bàn phím G92, chuột 4D)">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Mã sản phẩm <span style="color: red;">(*)</span></label>
                                        <input type="text" name="code" class="form-control" id="code"
                                            placeholder="Ex: NSA NK-1">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand <span style="color: red;">(*)</span></label>
                                        <select id="brand-id" name="brand" class="form-control select2bs4"
                                            style="width: 100%;">
                                            <option value="">Chọn nhãn hiệu</option>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Màu sắc <span style="color: red;">(*)</span></label>
                                        <input type="text" name="color" class="form-control" id="color"
                                            placeholder="Ex: Đen">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá sản phẩm <span style="color: red;">(*)</span></label>
                                        <input type="text" name="price" class="form-control" id="price"
                                            placeholder="Ex: 99000">
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Số lượng hàng nhập về kho <span
                                                style="color: red;">(*)</span></label>
                                        <input type="text" name="qty" class="form-control" id="qty" placeholder="Ex: 35">
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện <span style="color: red;">(*)</span></label>
                                        <span>Max: 3MB</span>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="avatar" class="custom-file-input" id="customFile"
                                                    accept="image/png, image/gif, image/jpeg, image/jpg">
                                                <label class="custom-file-label" for="avatar">Chọn ảnh đại diện</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2" id="preview-image" style="margin: auto;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Chuyên mục <span style="color: red;">(*)</span></label>
                                        <select id="category-id" name="category" class="form-control select2bs4"
                                            style="width: 100%;">
                                            <option value="">Chọn chuyên mục</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="cbHide" id="cb-hide">
                                            <label for="cb-hide">
                                                Ẩn mục này
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <label for="desc">Mô tả thông tin và cấu hình sản phẩm</label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px">
                                                                                  </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gallery">Thư viện hình ảnh</label> <span style="color: red;">(Max:
                                            3MB/image)</span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile2"
                                                accept="image/png, image/gif, image/jpeg, image/jpg" multiple>
                                            <label class="custom-file-label" for="customFile">Chọn các hình ảnh</label>
                                        </div>
                                    </div>
                                    <div class="row form-group p-2" id="preview-gallery">
                                    </div>
                                    <button type="button" id="btn-add" class="btn btn-primary">
                                        Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                $(function() {
                    // Multiple images preview in browser
                    var imagesPreview = function(input, placeToInsertImagePreview) {
                        if (input.files) {
                            var filesAmount = input.files.length;
                            for (i = 0; i < filesAmount; i++) {
                                var reader = new FileReader();
                                reader.onload = function(event) {
                                    $($.parseHTML('<img>')).attr('src', event.target.result).width('50%').height(
                                        'auto').appendTo(
                                        placeToInsertImagePreview);
                                }
                                reader.readAsDataURL(input.files[i]);
                            }
                        }
                    };
                    // for avatar
                    $('#customFile').on('change', function() {
                        $('#preview-image').empty();
                        if (this.files[0].size > 3145728) {
                            toastr.error('Maximum file size is 3MB!')
                            this.value = "";
                        } else {
                            imagesPreview(this, 'div#preview-image');
                        };
                    });
                    // for gallery
                    $('#customFile2').on('change', function() {
                        $('#preview-gallery').empty();
                        if (this.files[0].size > 3145728) {
                            toastr.error('Kích thước ảnh quá lớn! Vui lòng chọn ảnh có kích thước nhỏ hơn 3MB!')
                            this.value = "";
                        } else {
                            imagesPreview(this, 'div#preview-gallery');
                        };
                    });
                });
                $(document).ready(function() {
                    $('#btn-add').click(function(e) {
                        e.preventDefault();
                        var f = new FormData($('#f-add-product')[0]),
                            d = $('#compose-textarea').val(),
                            b = $('#brand-id').val();
                        c = $('#category-id').val();
                        f.append('desc', d);
                        f.append('brand_id', b);
                        f.append('category_id', c);
                        $.each($('#customFile2')[0].files, function(i, file) {
                            f.append('gallery[]', file);
                        });
                        $.ajax({
                            type: "post",
                            url: "{{route('admin.add.products')}}",
                            data: f,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.pass) {
                                    toastr.success(response.pass)
                                    setTimeout(() => {
                                        window.location.href = "{{route('admin.products')}}";
                                    }, 500);
                                } else if (response.fail) {
                                    toastr.error(response.fail)
                                }
                            }
                        });
                    });
                });
            </script>
        </section>
    </div>
@endsection
