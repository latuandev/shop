<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập trang quản lý website | ATUAN.CLUB</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../public/plugins/toastr/toastr.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="h1"><b>AT</b>uan</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Phiên đăng nhập dành cho Admin</p>

                <form action="#" method="post" id="f-login" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Tự động đăng nhập
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="button" id="btn-login" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#btn-login').click(function(e) {
                            e.preventDefault();
                            var f = new FormData($('#f-login')[0]);
                            $.ajax({
                                type: "post",
                                url: "{{route('admin.handle.login')}}",
                                data: f,
                                dataType: "json",
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if (response.pass) {
                                        window.location.href = "{{route('admin.dashboard')}}";
                                    } else if (response.fail) {
                                        toastr.error(response.fail)
                                    }
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="../public/plugins/toastr/toastr.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
