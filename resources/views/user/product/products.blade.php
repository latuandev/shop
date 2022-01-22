@extends('user.layout-layers-2')
@section('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="index, follow" />
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
    <!-- Begin Main Content Area  -->
    <main class="main-content">
        <div class="breadcrumb-area breadcrumb-height"
            data-bg-image="../public/assets/images/breadcrumb/bg/1-1-1919x388.jpg">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-12">
                        <div class="breadcrumb-item">
                            <h2 class="breadcrumb-heading">Sản phẩm</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li>Chi tiết sản phẩm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($productDetails as $item)
            <div class="single-product-area section-space-top-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-product-img">
                                <div class="swiper-container single-product-slider">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="../storage/app/public/images/{{ $item->avatar }}"
                                                class="single-img gallery-popup">
                                                <img class="img-full"
                                                    src="../storage/app/public/images/{{ $item->avatar }}"
                                                    alt="Product Image">
                                            </a>
                                        </div>
                                        @foreach ($galleries as $value)
                                            <div class="swiper-slide">
                                                <a href="../storage/app/public/images/{{ $value->image }}"
                                                    class="single-img gallery-popup">
                                                    <img class="img-full"
                                                        src="../storage/app/public/images/{{ $value->image }}"
                                                        alt="Product Image">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="thumbs-arrow-holder">
                                    <div class="swiper-container single-product-thumbs">
                                        <div class="swiper-wrapper">
                                            <a href="javascript:void(0);" class="swiper-slide">
                                                <img class="img-full"
                                                    src="../storage/app/public/images/{{ $item->avatar }}"
                                                    alt="Product Thumnail">
                                            </a>
                                            @foreach ($galleries as $value)
                                                <a href="javascript:void(0);" class="swiper-slide">
                                                    <img class="img-full"
                                                        src="../storage/app/public/images/{{ $value->image }}"
                                                        alt="Product Thumnail">
                                                </a>
                                            @endforeach
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class=" thumbs-button-wrap d-none d-md-block">
                                            <div class="thumbs-button-prev">
                                                <i class="pe-7s-angle-left"></i>
                                            </div>
                                            <div class="thumbs-button-next">
                                                <i class="pe-7s-angle-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pt-5 pt-lg-0">
                            <div class="single-product-content">
                                <h2 class="title">{{ $item->name }}</h2>
                                <div class="price-box">
                                    <span
                                        class="new-price">{{ App\Helper\Helpers::currencyFormat($item->price) }}</span>
                                </div>
                                <div class="rating-box-wrap">
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="fa fa-star"></i> Đã bán
                                                ({{ $item->qty_sold }})</li>
                                            <?php echo App\Helper\Helpers::productQuantity($item->qty, $item->qty_sold); ?>
                                        </ul>
                                    </div>
                                </div>
                                @if ($item->qty - $item->qty_sold > 0)
                                    <ul class="quantity-with-btn">
                                        <li class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text" id="qty">
                                            </div>
                                        </li>
                                        <li class="add-to-cart">
                                            <button class="btn btn-custom-size lg-size btn-pronia-primary"
                                                onclick="addToCart({{ $item->id }}, document.getElementById('qty').value)">Mua
                                                hàng</button>
                                        </li>
                                    </ul>
                                    <script>
                                        function addToCart(id, qty) {
                                            $.ajax({
                                                type: "post",
                                                url: "{{ route('add-to-cart') }}",
                                                data: {
                                                    id: id,
                                                    qty: qty
                                                },
                                                dataType: "json",
                                                success: function(response) {
                                                    window.location.href = "{{ route('cart') }}";
                                                }
                                            });
                                        }
                                    </script>
                                @endif
                                <ul class="service-item-wrap">
                                    <li class="service-item">
                                        <div class="service-img">
                                            <img src="../public/assets/images/shipping/icon/car.png" alt="Shipping Icon">
                                        </div>
                                        <div class="service-content">
                                            <span class="title">Miễn phí vận chuyển</span>
                                        </div>
                                    </li>
                                    <li class="service-item">
                                        <div class="service-img">
                                            <img src="../public/assets/images/shipping/icon/card.png" alt="Shipping Icon">
                                        </div>
                                        <div class="service-content">
                                            <span class="title">An toàn & uy tín</span>
                                        </div>
                                    </li>
                                    <li class="service-item">
                                        <div class="service-img">
                                            <img src="../public/assets/images/shipping/icon/service.png"
                                                alt="Shipping Icon">
                                        </div>
                                        <div class="service-content">
                                            <span class="title">Dịch vụ thân thiện</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="product-category">
                                    <span class="title">Mã sản phẩm:</span>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">{{ $item->code }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-category">
                                    <span class="title">Hãng:</span>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">{{ $item->brand }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-category">
                                    <span class="title">Màu sắc:</span>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">{{ $item->color }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-category">
                                    <span class="title">Danh mục:</span>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">{{ $item->category }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-category social-link align-items-center pb-0">
                                    <span class="title pe-3">Share:</span>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" data-tippy="Pinterest" data-tippy-inertia="true"
                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                <i class="fa fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-tippy="Twitter" data-tippy-inertia="true"
                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-tippy="Tumblr" data-tippy-inertia="true"
                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                <i class="fa fa-tumblr"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-tippy="Dribbble" data-tippy-inertia="true"
                                                data-tippy-animation="shift-away" data-tippy-delay="50"
                                                data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                                <i class="fa fa-dribbble"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-tab-area section-space-top-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav product-tab-nav tab-style-2 pt-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="active tab-btn" id="description-tab" data-bs-toggle="tab" href="#description"
                                        role="tab" aria-controls="description" aria-selected="true">
                                        Thông tin sản phẩm
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content product-tab-content">
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="product-description-body">
                                        <p class="short-desc mb-0">
                                            <?php
                                            if ($item->desc) {
                                                echo htmlspecialchars_decode($item->desc);
                                            } else {
                                                echo '<h4>Chưa có thông tin sản phẩm!</h4>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Begin Product Area -->
        <div class="product-area section-space-y-axis-90">
            <div class="container">
                <div class="row">
                    <div class="section-title-wrap without-tab">
                        <h2 class="section-title">Sản phẩm liên quan</h2>
                    </div>
                    <div class="col-lg-12">
                        <div class="swiper-container product-slider">
                            <div class="swiper-wrapper">
                                @foreach ($relatedProducts as $item)
                                    <div class="swiper-slide product-item">
                                        <div class="product-img">
                                            <a href="{{ url('/products') }}/{{ $item->url }}">
                                                <img class="primary-img"
                                                    src="../storage/app/public/images/{{ $item->avatar }}"
                                                    alt="Product Images">
                                                <img class="secondary-img"
                                                    src="../storage/app/public/images/{{ $item->avatar }}"
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
@endsection
