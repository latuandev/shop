@extends('user.layout-layers-1')
@section('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quên mật khẩu - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Quên mật khẩu - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Quên mật khẩu - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Quên mật khẩu - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
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
                            <h2 class="breadcrumb-heading">Quên mật khẩu</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li>Quên mật khẩu</li>
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
                        <form id="f-forgot-password" action="javascript:void(0);" method="POST"
                            enctype="multipart/form-data">
                            <div class="login-form">
                                <h4 class="login-title">Quên mật khẩu</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" placeholder="Nhập email của bạn">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-lg-12">
                                            <button type="button" id="btn-forgot-password"
                                                class="btn btn-custom-size lg-size btn-pronia-primary">Đặt lại mật
                                                khẩu</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pt-3 mt-md-0">
                                        <div class="forgotton-password_info">
                                            <a href="{{ route('user.login') }}"> Đăng nhập</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 pt-5"
                                        style="display: flex; align-items: center; justify-content: center;">
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
    </main>
    <script>
        $(document).on('click', '#btn-forgot-password', function() {
            var f = new FormData($('#f-forgot-password')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('user.reset-password') }}",
                data: f,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.fail) {
                        toastr.error(response.fail)
                    } else if (response.pass) {
                        toastr.success(response.pass)
                        $('#div-form').empty();
                        $('#div-form').append(response.reset);
                    }
                }
            });
        });
        $(document).on('click', '#btn-reset-password', function() {
            var f = new FormData($('#f-reset-password')[0]),
                email = $('#hd-email').val();
            f.append('email', email);
            $.ajax({
                type: "post",
                url: "{{ route('user.reset-password.handle') }}",
                data: f,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.fail) {
                        toastr.error(response.fail)
                    } else if (response.pass) {
                        toastr.success(response.pass)
                        setTimeout(() => {
                            window.location.href = "{{ route('user.login') }}";
                        }, 500);
                    }
                }
            });
        });
        $(document).on('click', '#btn-resend-email', function() {
            var email = $('#hd-email').val(),
                name = $('#hd-name').val();
            bootbox.confirm({
                message: "Vui lòng chờ 1 phút trước khi nhấn gửi lại mã!",
                closeButton: false,
                buttons: {
                    confirm: {
                        label: 'Chờ 1 phút',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Gửi lại mã',
                        className: 'btn-primary'
                    }
                },
                callback: function(result) {
                    if (result == false) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('user.resend-code') }}",
                            data: {
                                email: email,
                                name: name
                            },
                            dataType: "json",
                            success: function(response) {
                                toastr.success(response)
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
