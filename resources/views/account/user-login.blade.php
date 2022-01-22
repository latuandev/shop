@extends('user.layout-layers-1')
@section('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Đăng nhập - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Đăng nhập - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Đăng nhập - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
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
                            <h2 class="breadcrumb-heading">Đăng nhập</h2>
                            <ul>
                                <li>
                                    <a href="{{route('home')}}">Trang chủ</a>
                                </li>
                                <li>Đăng nhập</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-register-area section-space-y-axis-100" style="height: 100vh;">
            <div class="container">
                <div class="row" style="display: flex; align-items: center; justify-content: center;">
                    <div class="col-lg-6" id="div-form">
                        <form id="f-login" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                            <div class="login-form">
                                <h4 class="login-title">Đăng nhập</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" placeholder="">
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" id="password" placeholder="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="check-box">
                                            <input type="checkbox" name="remember" id="remember_me">
                                            <label for="remember_me">Tự động đăng nhập</label>
                                        </div>
                                        <div class="col-lg-12 pt-5">
                                            <button id="btn-login" type="button" class="btn btn-custom-size lg-size btn-pronia-primary">Đăng nhập</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pt-1 mt-md-0">
                                        <div class="forgotton-password_info">
                                            <a href="{{route('user.forgot-password')}}"> Quên mật khẩu?</a>
                                        </div>
                                        <div class="forgotton-password_info">
                                            <a href="{{route('user.register')}}"> Đăng ký</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 pt-5" style="display: flex; align-items: center; justify-content: center;">
                                        Đăng nhập bằng &nbsp;<a href="{{route('login-with-facebook')}}"><i class="fa fa-facebook fa-2x"></i></a>
                                        &nbsp; hoặc &nbsp;<a href="{{route('login-with-google')}}"><i class="fa fa-google fa-2x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
        <input type="hidden" id="hd-error" value="{{$errors->first()}}">
        <script>
            $(document).ready(function () {
                var error = $('#hd-error').val();
                toastr.error(error)
            });
        </script>
        @endif
    </main>
    <script>
        $(document).on('click', '#btn-login', function () {
            var f = new FormData($('#f-login')[0]);
            $.ajax({
                type: "post",
                url: "{{route('user.login.handle')}}",
                data: f,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.fail) {
                        toastr.error(response.fail)
                    } else if(response.pass) {
                        window.location.href= "{{route('cart')}}";
                    }
                }
            });
        });
    </script>
@endsection
