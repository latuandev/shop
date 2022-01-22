@extends('user.layout-layers-1')
@section('meta')
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kết quả tìm kiếm cho '<?php echo $_GET['key']; ?>' - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Kết quả tìm kiếm cho '<?php echo $_GET['key']; ?>' - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Kết quả tìm kiếm cho '<?php echo $_GET['key']; ?>' - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Kết quả tìm kiếm cho '<?php echo $_GET['key']; ?>' - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
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
    <main class="main-content">
        <div class="breadcrumb-area breadcrumb-height" data-bg-image="public/assets/images/breadcrumb/bg/1-1-1919x388.jpg">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-12">
                        <div class="breadcrumb-item">
                            <h2 class="breadcrumb-heading">Shop</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li>
                                    Kết quả tìm kiếm cho: <b><?php echo $_GET['key']; ?></b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Begin Product Area -->
    <div class="product-area section-space-top-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="margin-bottom: 100px;">
                    <div class="product-topbar">
                        <ul>
                            @if ($results->count() > 0)
                                <li class="page-count">
                                    Tìm thấy
                                    <span>{{ $results->count() }}</span>
                                    sản phẩm
                                </li>
                                <li class="short">
                                    <select class="nice-select" id="sl-sort"
                                        onchange="var optionVal = $(this).find(':selected').val(); getValue(optionVal)">
                                        <option value="1">Sắp xếp từ A-Z</option>
                                        <option value="2">Sắp xếp theo giá từ thấp đến cao</option>
                                        <option value="3">Sắp xếp theo giá từ cao đến thấp</option>
                                    </select>
                                </li>
                            @else
                                <li style="text-align: center">
                                    <h4>Không tìm thấy bất kì kết quả nào!</h4><br>
                                    <ul style="text-align: left">
                                        <b>Để tìm được kết quả chính xác hơn, bạn vui lòng:</b>
                                        <li>- Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
                                        <li>- Thử lại bằng từ khóa khác</li>
                                        <li>- Thử lại bằng những từ khóa tổng quát hơn</li>
                                        <li>- Thử lại bằng những từ khóa ngắn gọn hơn</li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div id="data-list" class="product-item-wrap row">
                        @foreach ($results as $item)
                            <div class="sum-div col-xl-3 col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ url('/products') }}/{{ $item->url }}">
                                            <img style="height: auto;" class="primary-img"
                                                src="storage/app/public/images/{{ $item->avatar }}" alt="Product Images">
                                            <img style="height: auto;" class="secondary-img"
                                                src="storage/app/public/images/{{ $item->avatar }}" alt="Product Images">
                                        </a>
                                        @if ($item->qty - $item->qty_sold > 0)
                                                            <div class="product-add-action">
                                                                <ul>
                                                                    <li>
                                                                        <button class="btn btn-primary"
                                                                            onclick="addToCartFunction({{ $item->id }})"
                                                                            style="background-color: #abd373; border: transparent;"
                                                                            data-tippy="" data-tippy-inertia="true"
                                                                            data-tippy-animation="shift-away"
                                                                            data-tippy-delay="50" data-tippy-arrow="true"
                                                                            data-tippy-theme="sharpborder">
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
                    @if ($results->count() >= 12)
                            <div class="pagination-area">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item active">
                                            <button id="btn-load-more"
                                                style="background-color: #abd373; border: 1px transparent;"
                                                class="btn btn-primary" data-totalResult="{{ $results->count() }}">Xem
                                                thêm</button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @endif
                        <input type="hidden" id="hd-key" value="<?php echo $_GET['key']; ?>">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#btn-load-more").on('click', function(_totalCurrentResult) {
                var sumDiv = $(".sum-div").length,
                    selectId = $('#sl-sort').val(),
                    key = $('#hd-key').val();
                $.ajax({
                    url: "{{route('load-more-data.search')}}",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        skip: sumDiv,
                        selectId: selectId,
                        key: key
                    },
                    beforeSend: function() {
                        $("#btn-load-more").html('Đang tải thêm...');
                    },
                    success: function(response) {
                        $("#data-list").append(response);
                        var currentSumDiv = $(".sum-div").length,
                            sumProducts = parseInt($("#btn-load-more").attr(
                                'data-totalResult'));
                        // Change Load More When No Further result
                        if (currentSumDiv == sumProducts) {
                            $(".pagination-area").hide();
                        } else {
                            $("#btn-load-more").html('Xem thêm');
                        }
                    }
                });
            });
        });
        function ajaxLoad(param) {
            var key = $('#hd-key').val();
            $.ajax({
                type: "get",
                url: "{{route('search')}}",
                data: {
                    selectId: param,
                    key: key
                },
                dataType: "json",
                success: function(response) {
                    $('#data-list').empty();
                    $('#data-list').append(response);
                    $('.pagination-area').show();
                    $("#btn-load-more").html('Xem thêm');
                }
            });
        }

        // selected option
        function getValue(param) {
            if ($(param.selected)) {
                if (param == 1) {
                    ajaxLoad(1)
                } else if (param == 2) {
                    ajaxLoad(2)
                } else if(param == 3) {
                    ajaxLoad(3)
                }
            }
        }
    </script>
@endsection
