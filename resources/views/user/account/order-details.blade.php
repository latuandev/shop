@extends('user.layout-layers-2')
@section('meta')
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
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
                            <h2 class="breadcrumb-heading">Tài khoản</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li>{{ Auth::user()->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-page-area section-space-y-axis-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-orders-tab" data-bs-toggle="tab"
                                    href="#account-orders" role="tab" aria-controls="account-orders"
                                    aria-selected="false">Đơn đặt hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-bs-toggle="tab"
                                    href="#account-details" role="tab" aria-controls="account-details"
                                    aria-selected="false">Thông tin tài khoản</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" href="{{ route('user.logout') }}"
                                    role="tab" aria-selected="false">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade show active" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="small-title">Đơn hàng của tôi</h4>
                                    <div class="table-responsive">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <div class="myaccount-details">
                                    <form id="f-info" action="javascript:void(0);" class="myaccount-form">
                                        <div class="myaccount-form-inner">
                                            <div class="single-input single-input-half">
                                                <label>Tên</label>
                                                <input type="text" name="name" value="{{Auth::user()->name}}">
                                            </div>
                                            <div class="single-input single-input-half">
                                                <label>SĐT</label>
                                                <input type="text" name="phone" value="{{Auth::user()->phone}}">
                                            </div>
                                            <div class="single-input">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{Auth::user()->email}}">
                                            </div>
                                            <div class="single-input">
                                                <label>Mật khẩu hiện tại (Để trống để không thay đổi)</label>
                                                <input type="password" name="current_password">
                                            </div>
                                            <div class="single-input">
                                                <label>Mật khẩu mới (Để trống để không thay đổi)</label>
                                                <input type="password" name="new_password">
                                            </div>
                                            <div class="single-input">
                                                <label>Xác nhận mật khẩu mới (Để trống để không thay đổi)</label>
                                                <input type="password" name="confirm_new_password">
                                            </div>
                                            <div class="single-input">
                                                <button id="btn-save" class="btn btn-custom-size lg-size btn-pronia-primary"
                                                    type="submit">
                                                    <span>Lưu thay đổi</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
