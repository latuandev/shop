@extends('user.layout-layers-2')
@section('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (!$products->isEmpty())
        @foreach ($products as $item)
            <title>{{ $item->category_name }} - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
            <meta name="robots" content="index, follow" />
            <meta name="description" content="{{ $item->category_name }} - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
            <meta property="og:description"
                content="{{ $item->category_name }} - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
            <meta property="twitter:description"
                content="{{ $item->category_name }} - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
        @break
    @endforeach
@else
    <title>Danh mục sản phẩm - Thiết bị chơi game cầm tay hàng đầu Việt Nam | ATUAN.CLUB</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Danh mục sản phẩm - Thiết bị chơi game cầm tay hàng đầu Việt Nam">
    <meta property="og:description" content="Danh mục sản phẩm - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    <meta property="twitter:description" content="Danh mục sản phẩm - Thiết bị chơi game cầm tay hàng đầu Việt Nam" />
    @endif
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
        <div class="breadcrumb-area breadcrumb-height"
            data-bg-image="../public/assets/images/breadcrumb/bg/1-1-1919x388.jpg">
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
                                    @if (!$products->isEmpty())
                                        @foreach ($products as $item)
                                            {{ $item->category_name }}
                                        @break
                                    @endforeach
                                @else
                                    Danh mục sản phẩm
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-area section-space-y-axis-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 order-2 order-lg-1 pt-5 pt-lg-0">
                        <div class="sidebar-area">
                            <div class="widgets-searchbox">
                                <form id="widgets-searchbox" action="{{ route('search') }}" method="GET">
                                    <input class="input-field" name="key" type="text" placeholder="Tìm kiếm...">
                                    <button class="widgets-searchbox-btn" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="widgets-area">
                                <div class="widgets-item pt-0">
                                    <h2 class="widgets-title mb-4">Danh mục</h2>
                                    <ul class="widgets-category">
                                        @foreach ($categories as $item)
                                            <li>
                                                <a href="{{ url('/categories') }}/{{ $item->url }}">
                                                    <i class="fa fa-chevron-right"></i>
                                                    <span>{{ $item->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="widgets-item">
                                    <h2 class="widgets-title mb-4">Hãng</h2>
                                    <ul class="widgets-category widgets-color">
                                        @foreach ($brands as $item)
                                            <li>
                                                <a href="{{ url('/brands') }}/{{ $item->url }}">
                                                    <i class="fa fa-chevron-right"></i>
                                                    <span>{{ $item->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @foreach ($newProduct as $item)
                                <div class="banner-item widgets-banner img-hover-effect">
                                    <div class="banner-img">
                                        <img src="../storage/app/public/images/{{ $item->avatar }}" alt="Banner Image">
                                    </div>
                                    <div class="banner-content text-position-center">
                                        <span class="collection">Sản phẩm mới</span>
                                        <h3 class="title">
                                            <?php
                                            $countStr = strlen($item->name);
                                            if ($countStr <= 40) {
                                                echo $item->name;
                                            } else {
                                                echo substr_replace($item->name, '...', 40);
                                            }
                                            ?>
                                        </h3>
                                        <div class="button-wrap">
                                            <a class="btn btn-custom-size sm-size btn-pronia-primary"
                                                href="{{ url('/products') }}/{{ $item->url }}">Xem ngay</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 order-1 order-lg-2">
                        <div class="product-topbar">
                            <ul>
                                @if ($products->count() > 0)
                                    <li class="page-count">
                                        Tổng số
                                        <span>{{ $sumProducts }}</span>
                                        sản phẩm
                                    </li>
                                    <li class="short">
                                        <select class="nice-select" id="sl-sort"
                                            onchange="var optionVal = $(this).find(':selected').val(); getValue(optionVal)">
                                            <option value="1" selected="selected">Sắp xếp theo A-Z</option>
                                            <option value="2">Sắp xếp theo sản phẩm bán chạy</option>
                                            <option value="3">Sắp xếp theo giá từ thấp đến cao</option>
                                            <option value="4">Sắp xếp theo giá từ cao đến thấp</option>
                                        </select>
                                    </li>
                                @else
                                    <li style="text-align: center">
                                        <h4>Không có dữ liệu sản phẩm</h4>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="grid-view" role="tabpanel"
                                aria-labelledby="grid-view-tab">
                                <div id="data-list" class="product-grid-view row g-y-20">
                                    @if ($products->count() > 0)
                                        @foreach ($products as $item)
                                            <div class="sum-div col-md-4 col-sm-6">
                                                <div class="product-item">
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
                                    @endif
                                </div>
                            </div>
                            @if ($products->count() >= 6)
                                <div class="pagination-area">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item active">
                                                <button id="btn-load-more"
                                                    style="background-color: #abd373; border: 1px transparent;"
                                                    class="btn btn-primary" data-totalResult="{{ $sumProducts }}">Xem
                                                    thêm</button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                            <input type="hidden" id="hd-url" value="{{ request()->url }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $("#btn-load-more").on('click', function(_totalCurrentResult) {
                var sumDiv = $(".sum-div").length,
                    selectId = $('#sl-sort').val(),
                    url = $('#hd-url').val();
                $.ajax({
                    url: "../categories/" + url + "/load-more-data",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        skip: sumDiv,
                        selectId: selectId
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
            var url = $('#hd-url').val();
            $.ajax({
                type: "get",
                url: "../categories/" + url,
                data: {
                    selectId: param
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
                } else if (param == 3) {
                    ajaxLoad(3)
                } else if (param == 4) {
                    ajaxLoad(4)
                }
            }
        }
    </script>
@endsection
