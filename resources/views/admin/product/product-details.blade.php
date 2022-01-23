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
                        <h1 class="m-0">Chi tiết sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Danh sách sản phẩm</a></li>
                            <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @foreach ($productDetails as $item)
                    <form action="" id="f-edit-product" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <a href="{{ route('admin.products') }}" class="btn btn-primary btn-block mb-3">Quay lại danh
                                    sách sản phẩm</a>
                                <input type="hidden" id="hidden-url" value="{{ $item->url }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Tên sản phẩm <span style="color: red;">(*)</span></label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Ex: Bộ chuyển đổi chơi game bằng chuột, bàn phím cho máy PS4,Xbox One, Nintendo Switch Aturos MK-1 (Tặng kèm bàn phím G92, chuột 4D)"
                                                value="{{ $item->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Mã sản phẩm</label>
                                            <input type="text" name="code" class="form-control" id="code"
                                                placeholder="Ex: NSA NK-1" value="{{ $item->code }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Brand <span style="color: red;">(*)</span></label>
                                            <select id="brand-id" class="form-control select2bs4" style="width: 100%;">
                                                <option value="{{ $item->brand_id }}" selected>{{ $item->brand }}
                                                </option>
                                                @foreach ($brands as $value)
                                                    @if ($value->id == $item->brand_id)
                                                        @continue
                                                    @endif
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="color">Màu sắc <span style="color: red;">(*)</span></label>
                                            <input type="text" name="color" class="form-control" id="color"
                                                placeholder="Ex: Đen" value="{{ $item->color }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá sản phẩm <span style="color: red;">(*)</span></label>
                                            <input type="text" name="price" class="form-control" id="price"
                                                placeholder="Ex: 99000" value="{{ $item->price }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Số lượng hàng nhập về kho <span
                                                    style="color: red;">(*)</span></label>
                                            <input type="text" name="qty" class="form-control" id="qty"
                                                placeholder="Ex: 35" value="{{ $item->qty }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar">Ảnh đại diện <span style="color: red;">(*)</span></label>
                                            <span>Max: 3MB</span>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="avatar" class="custom-file-input"
                                                        id="customFile"
                                                        accept="image/png, image/gif, image/jpeg, image/jpg">
                                                    <label class="custom-file-label" for="avatar">Chọn ảnh đại diện</label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2" id="preview-image" style="margin: auto;">
                                                <div class="row p-2">
                                                    <a href="../../storage/app/public/images/{{ $item->avatar }}"
                                                        data-toggle="lightbox" data-title="{{ $item->avatar }}"
                                                        data-gallery="gallery">
                                                        <img src="../../storage/app/public/images/{{ $item->avatar }}"
                                                            class="img-fluid mb-2" alt="{{ $item->avatar }}"
                                                            style="width: 50%;" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Chuyên mục <span style="color: red;">(*)</span></label>
                                            <select id="category-id" class="form-control select2bs4" style="width: 100%;">
                                                <option value="{{ $item->category_id }}" selected>{{ $item->category }}
                                                </option>
                                                @foreach ($categories as $value)
                                                    @if ($value->id == $item->category_id)
                                                        @continue
                                                    @endif
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    {{ $item->desc }}</textarea>
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
                                        @if (count($galleries) > 1)
                                            <div class="card-body" id="galleries">
                                                <div class="row">
                                                    @foreach ($galleries as $value2)
                                                        <div class="col-sm-4">
                                                            <a href="../../storage/app/public/images/{{ $value2->image }}"
                                                                data-toggle="lightbox" data-title="{{ $value2->image }}"
                                                                data-gallery="gallery">
                                                                <img src="../../storage/app/public/images/{{ $value2->image }}"
                                                                    class="img-fluid mb-2" alt="{{ $value2->image }}" />
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-block btn-danger btn-sm"
                                                    onclick="deleteGalleryFunction('{{ $item->url }}')">Xóa
                                                    thư
                                                    viện ảnh này</button>
                                            </div>
                                        @endif
                                        <div class="row form-group p-2" id="preview-gallery">
                                        </div>
                                        <button type="button" id="btn-edit" class="btn btn-primary">
                                            Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
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
                    $('#btn-edit').click(function(e) {
                        e.preventDefault();
                        var f = new FormData($('#f-edit-product')[0]),
                            u = $('#hidden-url').val();
                        d = $('#compose-textarea').val(),
                            b = $('#brand-id').val();
                        c = $('#category-id').val();
                        f.append('url', u);
                        f.append('desc', d);
                        f.append('brand_id', b);
                        f.append('category_id', c);
                        $.each($('#customFile2')[0].files, function(i, file) {
                            f.append('gallery[]', file);
                        });
                        $.ajax({
                            type: "post",
                            url: "{{route('admin.edit.products')}}",
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
                //
                function deleteGalleryFunction(url) {
                    bootbox.confirm("Bạn có muốn xóa thư viện ảnh này không?", function(result) {
                        if (result == true) {
                            $.ajax({
                                type: "post",
                                url: "{{route('admin.delete-galleries.products')}}",
                                data: {
                                    url: url
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.fail) {
                                        toastr.error(response.fail)
                                    } else {
                                        toastr.success(response.pass)
                                        $('#galleries').remove();
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
