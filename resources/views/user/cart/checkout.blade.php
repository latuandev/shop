<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thanh toán giỏ hàng - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Thanh toán giỏ hàng - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Thanh toán giỏ hàng - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Thanh toán giỏ hàng - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="og:site_name" content="ATUAN.CLUB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="ATUAN.CLUB" />
    <meta property="twitter:title" content="ATUAN.CLUB" />
    <meta property="og:url" content="https://atuan.club/" />
    <!-- Louis Tang Mod Open Graph Image -->
    <meta property="og:image" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/images/favicon.ico" />

    <!-- CSS
    ============================================ -->

    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="public/assets/css/Pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="public/assets/css/animate.min.css">
    <link rel="stylesheet" href="public/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="public/assets/css/nice-select.css">
    <link rel="stylesheet" href="public/assets/css/magnific-popup.min.css" />
    <link rel="stylesheet" href="public/assets/css/ion.rangeSlider.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="public/plugins/toastr/toastr.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
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
                                    <img src="public/assets/images/logo/atuan-logo.png" alt="Header Logo">
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
                                    <img src="public/assets/images/logo/atuan-logo.png" alt="Header Logo">
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
                                            src="storage/app/public/images/{{ $item->options['avatar'] }}"
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
            </div>
            <div class="global-overlay"></div>
        </header>

                <!-- Begin Main Content Area -->
                <main class="main-content">
                    <div class="breadcrumb-area breadcrumb-height" data-bg-image="public/assets/images/breadcrumb/bg/1-1-1919x388.jpg">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col-lg-12">
                                    <div class="breadcrumb-item">
                                        <h2 class="breadcrumb-heading">Thanh toán</h2>
                                        <ul>
                                            <li>
                                                <a href="{{route('home')}}">Trang chủ</a>
                                            </li>
                                            <li>
                                                <a href="{{route('cart')}}">Giỏ hàng</a>
                                            </li>
                                            <li>Thanh toán giỏ hàng</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-area section-space-y-axis-100">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-accordion">
                                        <h3>Bạn có mã giảm giá? <span id="showcoupon">Nhấn vào đây để sử dụng mã giảm giá của bạn</span></h3>
                                        <div id="checkout_coupon" class="coupon-checkout-content">
                                            <div class="coupon-info">
                                                <form action="javascript:void(0)" id="f-coupons" method="POST" enctype="multipart/form-data">
                                                    <p class="checkout-coupon">
                                                        <input name="coupons" id="coupons" placeholder="Mã giảm giá" type="text">
                                                        <input class="coupon-inner_btn" value="Sử dụng" type="submit" onclick="couponsFunction()">
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <form action="javascript:void(0)" id="f-ship" method="POST" enctype="multipart/form-data">
                                        <div class="checkbox-form">
                                            <h3>Chi tiết hóa đơn</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="country-select clearfix">
                                                        <label>Chọn địa điểm nhận hàng của bạn <span class="required" style="color: red;">*</span></label>
                                                        <select id="shipped" class="myniceselect nice-select wide">
                                                            @if ($ship->count() > 0)
                                                            <option value="0">Chọn địa điểm nhận hàng hoặc thêm địa chỉ mới ở phía dưới</option>
                                                            @foreach ($ship as $item)
                                                            <option value="{{$item->id}}"><?php echo $item->provice.', '.$item->district.', '.$item->street;?></option>
                                                            @endforeach
                                                            @else
                                                            <option value="0">Chưa có địa điểm nhận hàng</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="coupon-accordion">
                                                    <div style="background-color: #f1f1f1; padding: 16px 32px 16px; margin-bottom: 18px;"><span id="showlogin">Nhấn vào đây để thêm địa điểm nhận hàng mới</span></div>
                                                    <div id="checkout-login" class="coupon-content">
                                                        <div class="coupon-info row">
                                                            <div class="col-md-6">
                                                                <div class="checkout-form-list">
                                                                    <label>Tỉnh/Thành phố <span class="required" style="color:red;">*</span></label>
                                                                    <input placeholder="" name="provice" id="provice" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="checkout-form-list">
                                                                    <label>Quận/Huyện <span class="required" style="color:red;">*</span></label>
                                                                    <input placeholder="" name="district" id="district" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Số nhà, tên đường <span class="required" style="color:red;">*</span></label>
                                                                    <input placeholder="" name="street" id="street" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="checkout-form-list">
                                                                    <label>SĐT <span class="required" style="color:red;">*</span></label>
                                                                    <input placeholder="" name="phone" value="{{Auth::user()->phone}}" id="phone" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="checkout-form-list">
                                                                    <label>Email <span class="required" style="color:red;">*</span></label>
                                                                    <input placeholder="" name="email" id="email" value="{{Auth::user()->email}}" type="text" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="different-address">
                                                <div class="order-notes">
                                                    <div class="checkout-form-list checkout-form-list-2">
                                                        <label>Ghi chú (Tùy chọn)</label>
                                                        <textarea id="checkout-mess" cols="30" rows="10" placeholder="Bạn cần chúng tôi lưu ý gì trước khi giao hàng cho bạn?"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="your-order">
                                        <h3>Đơn hàng của bạn</h3>
                                        <div class="your-order-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="cart-product-name">Sản phẩm</th>
                                                        <th class="cart-product-total">Giá tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Cart::content() as $item)
                                                    <tr class="cart_item">
                                                        <td class="cart-product-name"> {{$item->name}}<strong
                                                        class="product-quantity">
                                                        × {{$item->qty}}</strong></td>
                                                        <td class="cart-product-total"><span class="amount">{{App\Helper\Helpers::currencyFormat($item->price)}}</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th>Tổng tiền sản phẩm</th>
                                                        <td><span class="amount">{{App\Helper\Helpers::currencyFormat(Cart::subtotal())}}</span></td>
                                                    </tr>
                                                    <tr class="cart-subtotal-coupons">
                                                        <th>Giảm giá</th>
                                                        <td><span class="amount">0%</span></td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>Phí vận chuyển</th>
                                                        @if (Cart::subtotal() > 1500000)
                                                        <td><span class="amount"><?php echo App\Helper\Helpers::currencyFormat(0); $ship = 0;?></span></td>
                                                        @else
                                                        <td><span class="amount"><?php echo App\Helper\Helpers::currencyFormat(30000); $ship = 30000;?></span></td>
                                                        @endif
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng tiền cần trả</th>
                                                        <td><strong><span class="amount">{{App\Helper\Helpers::currencyFormat(Cart::subtotal()+$ship)}}</span></strong></td>
                                                        <input type="hidden" id="hd-total" value="{{Cart::subtotal()+$ship}}">
                                                        <input type="hidden" id="hd-coupons" value="0">
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-method">
                                            <div class="payment-accordion">
                                                <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header" id="#payment-1">
                                                            <h5 class="panel-title">
                                                                <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                                                    Giao hàng toàn quốc
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                                                            <div class="card-body">
                                                                <p>Chúng tôi giao hàng toàn quốc chỉ với 30k phí vận chuyển. Miễn phí vận chuyển nếu đơn hàng của bạn giá trị lớn hơn 1.500.000 VND</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="#payment-2">
                                                            <h5 class="panel-title">
                                                                <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                                                                    Thanh toán khi nhận hàng
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                                            <div class="card-body">
                                                                <p>Yên tâm hơn khi bạn nhận được sản phẩm rồi mới thanh toán, tránh trường hợp rủi ro tài sản.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="#payment-3">
                                                            <h5 class="panel-title">
                                                                <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                                                                    Bảo hành, đổi trả 1:1 trong vòng 30 ngày
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                                                            <div class="card-body">
                                                                <p>Chúng tôi cam kết sản phẩm đạt chất lượng tiêu chuẩn từ nhà sản xuất, đổi trả 1 đổi 1 trong vòng 30 ngày nếu có lỗi từ nhà sản xuất.<br>Bảo hàng sản phẩm theo thời hạn của nhà sản xuất hoặc của chúng tôi (Hàng cũ).</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-button-payment">
                                                    <input value="Đặt hàng" type="submit" onclick="confirmFunction()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
                    function couponsFunction() {
                        var f = new FormData($('#f-coupons')[0]);
                        $.ajax({
                            type: "post",
                            url: "{{route('check-out.coupons')}}",
                            data: f,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if(response.fail) {
                                    toastr.error(response.fail)
                                } else if(response.pass) {
                                    toastr.success(response.pass)
                                    $('.cart-subtotal-coupons').html(response.coupons);
                                    $('.order-total').html(response.total);
                                }
                            }
                        });
                    }

                    function confirmFunction() {
                        var f = new FormData($('#f-ship')[0]),
                            note = $('#checkout-mess').val(),
                            shipped = $('#shipped').val(),
                            total = $('#hd-total').val();
                            coupons = $('#hd-coupons').val();
                            f.append('total', total);
                            f.append('note', note);
                            f.append('shipped', shipped);
                            f.append('coupons', coupons);
                        $.ajax({
                            type: "post",
                            url: "{{route('check-out.confirm')}}",
                            data: f,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if(response.fail) {
                                    toastr.error(response.fail)
                                } else if(response.pass) {
                                    toastr.success(response.pass)
                                    setTimeout(() => {
                                        window.location.href = "{{route('users')}}";
                                    }, 1000);
                                }
                            }
                        });
                    }
                </script>

        <!-- Begin Footer Area -->
        <div class="footer-area" data-bg-image="public/assets/images/footer/bg/1-1920x465.jpg">
            <div class="footer-top section-space-top-100 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-widget-item">
                                <div class="footer-widget-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="public/assets/images/logo/atuan-logo.png" alt="Logo">
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

    <script src="public/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="public/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="public/assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="public/assets/js/vendor/jquery.waypoints.js"></script>
    <script src="public/assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="public/assets/js/plugins/wow.min.js"></script>
    <script src="public/assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="public/assets/js/plugins/jquery.nice-select.js"></script>
    <script src="public/assets/js/plugins/parallax.min.js"></script>
    <script src="public/assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="public/assets/js/plugins/tippy.min.js"></script>
    <script src="public/assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="public/assets/js/plugins/mailchimp-ajax.js"></script>
    <script src="public/assets/js/plugins/jquery.counterup.js"></script>

    <!-- Toastr -->
    <script src="public/plugins/toastr/toastr.min.js"></script>
    <!-- bootbox code -->
    <script src="public/bootbox/bootbox.min.js"></script>
    <script src="public/bootbox/bootbox.locales.min.js"></script>

    <!--Main JS (Common Activation Codes)-->
    <script src="public/assets/js/main.js"></script>
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
