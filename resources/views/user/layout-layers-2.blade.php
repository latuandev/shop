<!DOCTYPE html>
<html lang="zxx">

<head>

    @yield('meta')

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../public/assets/images/favicon.ico" />

    <!-- CSS
    ============================================ -->

    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../public/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../public/assets/css/Pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="../public/assets/css/animate.min.css">
    <link rel="stylesheet" href="../public/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../public/assets/css/nice-select.css">
    <link rel="stylesheet" href="../public/assets/css/magnific-popup.min.css" />
    <link rel="stylesheet" href="../public/assets/css/ion.rangeSlider.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="../public/plugins/toastr/toastr.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body>
    <div class="main-wrapper">

        <!-- Begin Main Header Area -->
        <header class="main-header-area">
            <div class="header-top bg-pronia-primary d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="header-top-left">
                                <span class="pronia-offer">Chào mừng bạn đến với shop thiết bị chơi game cầm tay</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-top-right" style="padding: 5px;">
                                <span>ATUAN.CLUB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle py-30">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="header-middle-wrap position-relative">
                                <div class="header-contact d-none d-lg-flex">
                                    <i class="pe-7s-call"></i>
                                    <a href="tel:0905922923">0905 922 923</a>
                                </div>

                                <a href="{{ route('home') }}" class="header-logo">
                                    <img src="../public/assets/images/logo/atuan-logo.png" alt="Header Logo">
                                </a>

                                <div class="header-right">
                                    <ul>
                                        <li>
                                            <a href="#exampleModal" class="search-btn bt" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="pe-7s-search"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown d-none d-lg-block">
                                            <button class="btn btn-link dropdown-toggle ht-btn p-0" type="button"
                                                id="settingButton" data-bs-toggle="dropdown" aria-label="setting"
                                                aria-expanded="false">
                                                <i class="pe-7s-users"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="settingButton">
                                                <li><a class="dropdown-item" href="{{ route('users') }}">Tài
                                                        khoản</a>
                                                </li>
                                                @if (!Auth::check())
                                                <li><a class="dropdown-item" href="{{ route('user.login') }}">Đăng
                                                        nhập
                                                        |
                                                        Đăng ký</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        <li class="minicart-wrap me-3 me-lg-0">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn" id="cart-qty-1">
                                                <i class="pe-7s-shopbag"></i>
                                                <span class="quantity">{{ Cart::count() }}</span>
                                            </a>
                                        </li>
                                        <li class="mobile-menu_wrap d-block d-lg-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn pl-0">
                                                <i class="pe-7s-menu"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-menu position-relative">
                                <nav class="main-nav">
                                    <ul>
                                        <li>
                                            <a href="{{ route('home') }}">Trang chủ</a>
                                        </li>
                                        <li class="drop-holder">
                                            <a href="javascript:void(0);">Shop</a>
                                            <ul class="drop-menu">
                                                @foreach ($categories as $item)
                                                    <li>
                                                        <a
                                                            href="{{ url('/categories') }}/{{ $item->url }}">{{ $item->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('about-us') }}">Giới thiệu</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-sticky py-4 py-lg-0">
                <div class="container">
                    <div class="header-nav position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-6">

                                <a href="{{ route('home') }}" class="header-logo">
                                    <img src="../public/assets/images/logo/atuan-logo.png" alt="Header Logo">
                                </a>

                            </div>
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="main-menu">
                                    <nav class="main-nav">
                                        <ul>
                                            <li>
                                                <a href="{{ route('home') }}">Trang chủ</a>
                                            </li>
                                            <li class="drop-holder">
                                                <a href="javascript:void(0);">Shop</a>
                                                <ul class="drop-menu">
                                                    @foreach ($categories as $item)
                                                        <li>
                                                            <a
                                                                href="{{ url('/categories') }}/{{ $item->url }}">{{ $item->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{ route('about-us') }}">Giới thiệu</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="header-right">
                                    <ul>
                                        <li>
                                            <a href="#exampleModal" class="search-btn bt" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="pe-7s-search"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown d-none d-lg-block">
                                            <button class="btn btn-link dropdown-toggle ht-btn p-0" type="button"
                                                id="settingButton" data-bs-toggle="dropdown" aria-label="setting"
                                                aria-expanded="false">
                                                <i class="pe-7s-users"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="settingButton">
                                                <li><a class="dropdown-item" href="{{ route('users') }}">Tài
                                                        khoản</a>
                                                </li>
                                                @if (!Auth::check())
                                                <li><a class="dropdown-item" href="{{ route('user.login') }}">Đăng
                                                        nhập
                                                        |
                                                        Đăng ký</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        <li class="minicart-wrap me-3 me-lg-0">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn" id="cart-qty-2">
                                                <i class="pe-7s-shopbag"></i>
                                                <span class="quantity">{{ Cart::count() }}</span>
                                            </a>
                                        </li>
                                        <li class="mobile-menu_wrap d-block d-lg-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn pl-0">
                                                <i class="pe-7s-menu"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-body">
                    <div class="inner-body">
                        <div class="offcanvas-top">
                            <a href="#" class="button-close"><i class="pe-7s-close"></i></a>
                        </div>
                        <div class="header-contact offcanvas-contact">
                            <i class="pe-7s-call"></i>
                            <a href="tel:0905922923">0905 922 923</a>
                        </div>
                        <div class="offcanvas-menu_area">
                            <nav class="offcanvas-navigation">
                                <ul class="mobile-menu">
                                    <li>
                                        <a href="{{ route('home') }}">
                                            <span class="mm-text">Trang chủ</span>
                                        </a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">
                                            <span class="mm-text">Shop
                                                <i class="pe-7s-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="sub-menu">
                                            @foreach ($categories as $item)
                                                <li>
                                                    <a href="{{ url('/categories') }}/{{ $item->url }}">
                                                        <span class="mm-text">{{ $item->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('users') }}">
                                            <span class="mm-text">Tài khoản</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about-us') }}">
                                            <span class="mm-text">Giới thiệu</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal"
                aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content modal-bg-dark">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                data-tippy="Close" data-tippy-inertia="true" data-tippy-animation="shift-away"
                                data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-search">
                                <form action="{{ route('search') }}" method="GET" class="hm-searchbox">
                                    <input type="text" name="key" value="" placeholder="Tìm kiếm...">
                                    <button class="search-btn" type="submit" aria-label="searchbtn">
                                        <i class="pe-7s-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-minicart_wrapper" id="miniCart">
                <div class="offcanvas-body">
                    <div class="minicart-content">
                        <div class="minicart-heading">
                            <h4 class="mb-0">Giỏ hàng mini</h4>
                            <a href="#" class="button-close"><i class="pe-7s-close" data-tippy="Close"
                                    data-tippy-inertia="true" data-tippy-animation="shift-away" data-tippy-delay="50"
                                    data-tippy-arrow="true" data-tippy-theme="sharpborder"></i></a>
                        </div>
                        <ul class="minicart-list">
                            @foreach (Cart::content() as $item)
                                <li class="minicart-product">
                                    <a href="{{ url('/products') }}/{{ $item->options['url'] }}"
                                        class="product-item_img">
                                        <img class="img-full"
                                            src="../storage/app/public/images/{{ $item->options['avatar'] }}"
                                            alt="Product Image">
                                    </a>
                                    <div class="product-item_content">
                                        <a class="product-item_title"
                                            href="{{ url('/products') }}/{{ $item->options['url'] }}">{{ $item->name }}</a>
                                        <span class="product-item_quantity"><b>SL: {{ $item->qty }}</b> x
                                            {{ App\Helper\Helpers::currencyFormat($item->price) }}</span>
                                    </div>
                                    <button class="btn btn-danger" style="height: 50px;"
                                        onclick="removeProductFromCart('{{ $item->rowId }}')">Xóa</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="minicart-item_total">
                        <span>Tổng (Đã bao gồm VAT)</span>
                        <span
                            class="ammount">{{ App\Helper\Helpers::currencyFormat(Cart::subtotal(null, null, '')) }}</span>
                    </div>
                    <div class="group-btn_wrap d-grid gap-2">
                        <a href="{{ route('cart') }}" class="btn btn-dark">Xem giỏ hàng</a>
                        @if (Cart::count() > 0)
                        <a href="{{ route('check-out') }}" class="btn btn-dark">Thanh toán</a>
                        @endif
                    </div>
                </div>
                <script>
                    function refreshData() {
                        // this's for cart page
                        $('#refresh-cart').load(location.href + ' #refresh-cart');
                        $(".minicart-list").load(location.href + " .minicart-list");
                        $(".ammount").load(location.href + " .ammount");
                        // this's for mini cart
                        $("#tbl-cart").load(location.href + " #tbl-cart");
                        $(".group-btn_wrap").load(location.href + " .group-btn_wrap");
                        $(".cart-page-total").load(location.href + " .cart-page-total");
                        $("#cart-qty-1").load(location.href + " #cart-qty-1");
                        $("#cart-qty-2").load(location.href + " #cart-qty-2");
                    }

                    function addToCartFunction(id) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('add-to-cart') }}",
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

                    function removeProductFromCart(id) {
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
                </script>
            </div>
            <div class="global-overlay"></div>
        </header>

        @yield('content')

        <!-- Begin Footer Area -->
        <div class="footer-area" data-bg-image="../public/assets/images/footer/bg/1-1920x465.jpg">
            <div class="footer-top section-space-top-100 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-widget-item">
                                <div class="footer-widget-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="../public/assets/images/logo/atuan-logo.png" alt="Logo">
                                    </a>
                                </div>
                                <p class="footer-widget-desc">
                                    Shop thiết bị chơi game cầm tay hàng đầu Việt Nam
                                </p>
                                <div class="social-link with-border">
                                    <ul>
                                        <li>
                                            <a href="https://facebook.com/latuan.dev" data-tippy="Facebook"
                                                data-tippy-inertia="true" data-tippy-animation="shift-away"
                                                data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-theme="sharpborder">
                                                <i class="fa fa-facebook"></i>
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
                                            <a href="javascript:void(0);" data-tippy="Pinterest"
                                                data-tippy-inertia="true" data-tippy-animation="shift-away"
                                                data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-theme="sharpborder">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-tippy="Dribbble"
                                                data-tippy-inertia="true" data-tippy-animation="shift-away"
                                                data-tippy-delay="50" data-tippy-arrow="true"
                                                data-tippy-theme="sharpborder">
                                                <i class="fa fa-dribbble"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 pt-40">
                            <div class="footer-widget-item">
                                <h3 class="footer-widget-title">Liên kết hữu ích</h3>
                                <ul class="footer-widget-list-item">
                                    <li>
                                        <a href="{{ route('home') }}">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about-us') }}">Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 pt-40">
                            <div class="footer-widget-item">
                                <h3 class="footer-widget-title">Tài khoản</h3>
                                <ul class="footer-widget-list-item">
                                    <li>
                                        <a href="{{ route('user.login') }}">Đăng nhập</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cart') }}">Giỏ hàng</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Chính sách</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 pt-40">
                            <div class="footer-widget-item">
                                <h3 class="footer-widget-title">Dịch vụ</h3>
                                <ul class="footer-widget-list-item">
                                    <li>
                                        <a href="javascript:void(0);">Giao hàng nhanh</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Thanh toán khi nhận hàng</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 pt-40">
                            <div class="footer-contact-info">
                                <h3 class="footer-widget-title">Liên hệ</h3>
                                <a class="number" href="tel:0905922923">0905 922 923</a>
                                <div class="address">
                                    <ul>
                                        <li>
                                            <a href="mailto:latuan.dev@gmail.com">latuan.dev@gmail.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright">
                                <span class="copyright-text">Powered by
                                    <a href="https://hasthemes.com/" rel="noopener" target="_blank">HasThemes</a> |
                                    Developed by <a href="https://facebook.com/latuan.dev" rel="noopener"
                                        target="_blank">Lê Anh Tuấn</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="scroll-to-top" href="">
            <i class="fa fa-angle-double-up"></i>
        </a>
        <!-- Scroll To Top End Here -->

    </div>

    <!-- Global Vendor, plugins JS -->

    <!-- JS Files
    ============================================ -->

    <script src="../public/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="../public/assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="../public/assets/js/vendor/jquery.waypoints.js"></script>
    <script src="../public/assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="../public/assets/js/plugins/wow.min.js"></script>
    <script src="../public/assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="../public/assets/js/plugins/jquery.nice-select.js"></script>
    <script src="../public/assets/js/plugins/parallax.min.js"></script>
    <script src="../public/assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="../public/assets/js/plugins/tippy.min.js"></script>
    <script src="../public/assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="../public/assets/js/plugins/mailchimp-ajax.js"></script>
    <script src="../public/assets/js/plugins/jquery.counterup.js"></script>

    <!-- Toastr -->
    <script src="../public/plugins/toastr/toastr.min.js"></script>
    <!-- bootbox code -->
    <script src="../public/bootbox/bootbox.min.js"></script>
    <script src="../public/bootbox/bootbox.locales.min.js"></script>

    <!--Main JS (Common Activation Codes)-->
    <script src="../public/assets/js/main.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        toastr.options = {
            "positionClass": "toast-top-left"
        };
    </script>

</body>

</html>
