@extends('user.layout-layers-1')
@section('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Giỏ hàng - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="og:site_name" content="ATUAN.CLUB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="ATUAN.CLUB" />
    <meta property="twitter:title" content="ATUAN.CLUB" />
    <meta property="og:url" content="https://atuan.club/" />
    <!-- Louis Tang Mod Open Graph Image -->
    <meta property="og:image" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('content')
    <!-- Begin Main Content Area -->
    <main class="main-content">
        <div class="breadcrumb-area breadcrumb-height" data-bg-image="public/assets/images/breadcrumb/bg/1-1-1919x388.jpg">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-12">
                        <div class="breadcrumb-item">
                            <h2 class="breadcrumb-heading">Giỏ hàng</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li>Chi tiết giỏ hàng</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-area section-space-y-axis-90" style="padding-bottom: 30px !important;">
            <div class="container" id="refresh-cart">
                @if (Cart::count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="table-content table-responsive" id="tbl-cart">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Xóa</th>
                                            <th class="product-thumbnail" style="width:112px;">Hình ảnh</th>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <td class="product_remove">
                                                    <button class="btn btn-danger"
                                                        onclick="removeFunction('{{ $item->rowId }}')">Xóa</button>
                                                </td>
                                                <td class="product-thumbnail">
                                                    <a href="storage/app/public/images/{{ $item->options['avatar'] }}">
                                                        <img src="storage/app/public/images/{{ $item->options['avatar'] }}"
                                                            alt="Cart Thumbnail">
                                                    </a>
                                                </td>
                                                <td class="product-name"><a
                                                        href="{{ url('/products') }}/{{ $item->options['url'] }}">{{ $item->name }}</a>
                                                </td>
                                                <td class="product-price"><span
                                                        class="amount">{{ App\Helper\Helpers::currencyFormat($item->price) }}</span>
                                                </td>
                                                <td class="quantity">
                                                    <div class="form-group">
                                                        <input type="hidden" id="hd-rowId" name="rowId"
                                                            value="{{ $item->rowId }}">
                                                        <input class="form-control" name="qty" value="{{ $item->qty }}"
                                                            type="text" id="qty"
                                                            style="width: inherit; text-align: center;">
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount"
                                                        id="product-total">{{ App\Helper\Helpers::currencyFormat($item->qty * $item->price) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon2">
                                            <button class="btn btn-danger" id="btn-remove-cart">Xóa giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Tổng tiền giỏ hàng</h2>
                                        <ul>
                                            <li>Tổng tiền (Đã bao gồm VAT) <span>{{ App\Helper\Helpers::currencyFormat(Cart::subtotal()) }}</span></li>
                                        </ul>
                                        <a href="{{ route('check-out') }}">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <h5 style="text-align: center">Danh sách sản phẩm bạn chọn sẽ hiển thị tại đây.</h5>
                            <p style="text-align: center;"><a href="{{ route('users') }}">Đi đến tài khoản của bạn</a></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Begin Product Area -->
        <div class="product-area section-space-y-axis-90" style="padding-top: 40px !important;">
            <div class="container">
                <div class="row">
                    <div class="section-title-wrap without-tab">
                        <h2 class="section-title">Sản phẩm gợi ý</h2>
                    </div>
                    <div class="col-lg-12">
                        <div class="swiper-container product-slider">
                            <div class="swiper-wrapper">
                                @foreach ($suggestedProducts as $item)
                                    <div class="swiper-slide product-item">
                                        <div class="product-img">
                                            <a href="{{ url('/products') }}/{{ $item->url }}">
                                                <img class="primary-img"
                                                    src="storage/app/public/images/{{ $item->avatar }}"
                                                    alt="Product Images">
                                                <img class="secondary-img"
                                                    src="storage/app/public/images/{{ $item->avatar }}"
                                                    alt="Product Images">
                                            </a>
                                            @if ($item->qty - $item->qty_sold > 0)
                                                <div class="product-add-action">
                                                    <ul>
                                                        <li>
                                                            <button class="btn btn-primary"
                                                                onclick="addToCartFunction({{ $item->id }})"
                                                                style="background-color: #abd373; border: transparent;"
                                                                data-tippy="" data-tippy-inertia="true"
                                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                                <i class="pe-7s-cart"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-content">
                                            <a class="product-name"
                                                href="{{ url('/products') }}/{{ $item->url }}">{{ $item->name }}</a>
                                            <div class="price-box pb-1">
                                                <span
                                                    class="new-price">{{ App\Helper\Helpers::currencyFormat($item->price) }}</span>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star"></i> Đã bán
                                                        ({{ $item->qty_sold }})</li>
                                                    <?php echo App\Helper\Helpers::productQuantity($item->qty, $item->qty_sold); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // update product qty
        $(document).on('change', '.form-control', function() {
            var div = $(this).closest('div'),
                qty = div.find('input[name="qty"]').val(),
                rowId = div.find('input[name="rowId"]').val();
            $.ajax({
                type: "post",
                url: "{{ route('update-cart') }}",
                data: {
                    rowId: rowId,
                    qty: qty
                },
                dataType: "json",
                success: function(response) {
                    refreshData();
                }
            });
        })

        // remove product item
        function removeFunction(id) {
            $.ajax({
                type: "post",
                url: "{{ route('remove-product-from-cart') }}",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    toastr.success(response)
                    refreshData();
                }
            });
        }
        // remove product cart
        $(document).on('click', '#btn-remove-cart', function() {
            bootbox.confirm({
                message: "Xác nhận xóa giỏ hàng!",
                closeButton: false,
                buttons: {
                    confirm: {
                        label: 'Xóa',
                        className: 'btn-primary'
                    },
                    cancel: {
                        label: 'Hủy',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result == true) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('remove-cart') }}",
                            dataType: "json",
                            success: function(response) {
                                toastr.success(response)
                                $('#refresh-cart').load(location.href + ' #refresh-cart');
                                refreshData();
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
