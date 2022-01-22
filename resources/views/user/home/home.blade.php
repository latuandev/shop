@extends('user.layout-layers-1')
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
    <!-- Begin Slider Area -->
    <div class="slider-area">

        <!-- Main Slider -->
        <div class="swiper-container main-slider swiper-arrow with-bg_white">
            <div class="swiper-wrapper">
                @foreach ($sliders as $item)
                    <div class="swiper-slide animation-style-01">
                        <div class="slide-inner style-1 bg-height" data-bg-image="public/assets/images/slider/bg/1-1.jpg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 order-2 order-lg-1 align-self-center">
                                        <div class="slide-content text-black">
                                            <h2 class="title" style="font-size: 36px;">Sản phẩm nổi bật</h2>
                                            <p class="short-desc">{{ $item->product_name }}
                                            </p>
                                            <div class="btn-wrap">
                                                <a class="btn btn-custom-size xl-size btn-pronia-primary"
                                                    href="{{ url('/products') }}/{{ $item->product_url }}">Đến shop
                                                    ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-0 order-1 order-lg-2">
                                        <div class="inner-img">
                                            <div class="scene fill">
                                                <div class="expand-width" data-depth="0.2">
                                                    <img src="storage/app/public/images/{{ $item->avatar }}"
                                                        alt="Inner Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination d-md-none"></div>

            <!-- Add Arrows -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>

    <!-- Begin Shipping Area -->
    <div class="shipping-area section-space-top-100">
        <div class="container">
            <div class="shipping-bg">
                <div class="row shipping-wrap">
                    <div class="col-lg-4 col-md-6">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="public/assets/images/shipping/icon/car.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">Miễn phí vận chuyển</h2>
                                <p class="short-desc mb-0">Cho đơn hàng từ 1.500.000 VND trở lên</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="public/assets/images/shipping/icon/card.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">An toàn & uy tín</h2>
                                <p class="short-desc mb-0">Cam kết, bảo đảm về sản phẩm và bảo hành</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                        <div class="shipping-item">
                            <div class="shipping-img">
                                <img src="public/assets/images/shipping/icon/service.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-content">
                                <h2 class="title">Dịch vụ</h2>
                                <p class="short-desc mb-0">Thân thiện & nhiệt tình với khách hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Product Area -->
    <div class="product-area section-space-top-100">
        <div class="container">
            <div class="section-title-wrap">
                <h2 class="section-title mb-0">Sản phẩm</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav product-tab-nav tab-style-1" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="active" id="featured-tab" data-bs-toggle="tab" href="#featured" role="tab"
                                aria-controls="featured" aria-selected="true">
                                Đặc trưng
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="bestseller-tab" data-bs-toggle="tab" href="#bestseller" role="tab"
                                aria-controls="bestseller" aria-selected="false">
                                Bán chạy nhất
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="latest-tab" data-bs-toggle="tab" href="#latest" role="tab" aria-controls="latest"
                                aria-selected="false">
                                Mới nhất
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                            <div class="product-item-wrap row">
                                @foreach ($featuredProducts as $item)
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ url('/products') }}/{{ $item->url }}">
                                                    <img style="height: auto;" class="primary-img"
                                                        src="storage/app/public/images/{{ $item->avatar }}"
                                                        alt="Product Images">
                                                    <img style="height: auto;" class="secondary-img"
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
                                                    href="{{ url('/products') }}/{{ $item->url }}"><?php echo App\Helper\Helpers::nameFormat($item->name); ?></a>
                                                <div class="price-box pb-1">
                                                    <span class="new-price"><?php echo App\Helper\Helpers::currencyFormat($item->price); ?></span>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bestseller" role="tabpanel" aria-labelledby="bestseller-tab">
                            <div class="product-item-wrap row">
                                @foreach ($bestSellerProducts as $item)
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ url('/products') }}/{{ $item->url }}">
                                                    <img style="height: auto;" class="primary-img"
                                                        src="storage/app/public/images/{{ $item->avatar }}"
                                                        alt="Product Images">
                                                    <img style="height: auto;" class="secondary-img"
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
                                                    href="{{ url('/products') }}/{{ $item->url }}"><?php echo App\Helper\Helpers::nameFormat($item->name); ?></a>
                                                <div class="price-box pb-1">
                                                    <span class="new-price"><?php echo App\Helper\Helpers::currencyFormat($item->price); ?>n>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                            <div class="product-item-wrap row">
                                @foreach ($latestProducts as $item)
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ url('/products') }}/{{ $item->url }}">
                                                    <img style="height: auto;" class="primary-img"
                                                        src="storage/app/public/images/{{ $item->avatar }}"
                                                        alt="Product Images">
                                                    <img style="height: auto;" class="secondary-img"
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
                                                    href="{{ url('/product') }}/{{ $item->url }}"><?php echo App\Helper\Helpers::nameFormat($item->name); ?></a>
                                                <div class="price-box pb-1">
                                                    <span class="new-price"><?php echo App\Helper\Helpers::currencyFormat($item->price); ?>n>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Brand Area -->
    <div class="brand-area section-space-bottom-100" style="padding-top: 100px;">
        <div class="container">
            <div class="brand-bg" data-bg-image="public/assets/images/brand/bg/1-1170x300.jpg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper-container brand-slider">
                            <div class="swiper-wrapper">
                                @foreach ($latestProducts as $item)
                                    <div class="swiper-slide">
                                        <a class="brand-item" href="{{ url('/products') }}/{{ $item->url }}">
                                            <img src="storage/app/public/images/{{ $item->avatar }}" alt="Brand Image">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
