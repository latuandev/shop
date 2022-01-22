<?php
namespace App\Helper;
class Helpers
{
    // convert timestamp
    public static function timestampFormat($timestamp)
    {
        $convertTime = strtotime($timestamp);
        $time = date("d-m-Y", $convertTime) . ' lúc ' . date("H:i", $convertTime);
        return $time;
    }
    // convert currency
    public static function currencyFormat($value, $suffix = ' VND')
    {
        return number_format($value, 0, ',', '.') . "{$suffix}";
    }
    // convert name
    public static function nameFormat($str) {
        $countStr = strlen($str);
        if ($countStr <= 100) {
            return $str;
        } else {
            return substr_replace($str, '...', 100);
        }
    }
    // check for product quantity
    public static function productQuantity($qty, $qtySold) {
        $rs = 0;
        $html = '';
        $rs = $qty - $qtySold;
        if($rs <= 0) {
            $html .= '
            <li><i class="fa fa-star"></i> <strong>Hết hàng</strong></li>
            ';
        }
        return $html;
    }
    // get products data as default with pagination = 6 (for selected options)
    public static function products($products) {
        $rs = '';
        foreach ($products as $key => $value) {
            $rs .= '
            <div class="sum-div col-md-4 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="'.url('/products').'/'.$value->url.'">
                            <img class="primary-img" src="../storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                            <img class="secondary-img" src="../storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                        </a>';
                        if (($value->qty - $value->qty_sold) > 0) {
                            $rs .= '
                            <div class="product-add-action">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary"
                                            onclick="addToCartFunction('.$value->id.')"
                                            style="background-color: #abd373; border: transparent;"
                                            data-tippy="" data-tippy-inertia="true"
                                            data-tippy-animation="shift-away" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                            <i class="pe-7s-cart"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
            $rs .= '
                    </div>
                    <div class="product-content">
                        <a class="product-name" href="'.url('/products').'/'.$value->url.'">'.Helpers::nameFormat($value->name).'</a>
                        <div class="price-box pb-1">
                            <span class="new-price">'.Helpers::currencyFormat($value->price).'</span>
                        </div>
                        <div class="rating-box">
                            <ul>
                                <li><i class="fa fa-star"></i> Đã bán ('.$value->qty_sold.')</li>
                                '.Helpers::productQuantity($value->qty, $value->qty_sold).'
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $rs;
    }
    // get load more products data with ajax pagination
    public static function loadMoreProducts($products) {
        $rs = '';
        foreach ($products as $key => $value) {
            $rs .= '
            <div class="sum-div col-md-4 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="'.url('/products').'/'.$value->url.'">
                            <img class="primary-img" src="../storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                            <img class="secondary-img" src="../storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                        </a>';
                        if (($value->qty - $value->qty_sold) > 0) {
                            $rs .= '
                            <div class="product-add-action">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary"
                                            onclick="addToCartFunction('.$value->id.')"
                                            style="background-color: #abd373; border: transparent;"
                                            data-tippy="" data-tippy-inertia="true"
                                            data-tippy-animation="shift-away" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                            <i class="pe-7s-cart"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
            $rs .= '
                    </div>
                    <div class="product-content">
                        <a class="product-name" href="'.url('/products').'/'.$value->url.'">'.Helpers::nameFormat($value->name).'</a>
                        <div class="price-box pb-1">
                            <span class="new-price">'.Helpers::currencyFormat($value->price).'</span>
                        </div>
                        <div class="rating-box">
                            <ul>
                                <li><i class="fa fa-star"></i> Đã bán ('.$value->qty_sold.')</li>
                                '.Helpers::productQuantity($value->qty, $value->qty_sold).'
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $rs;
    }
    // get data with ajax for selected options
    public static function searchData($results)
    {
        $rs = '';
        foreach ($results as $key => $value) {
            $rs .= '
            <div class="sum-div col-xl-3 col-md-4 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="'.url('/products').'/'.$value->url.'">
                            <img style="height: auto;" class="primary-img"
                                src="storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                            <img style="height: auto;" class="secondary-img"
                                src="storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                        </a>';
                        if (($value->qty - $value->qty_sold) > 0) {
                            $rs .= '
                            <div class="product-add-action">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary"
                                            onclick="addToCartFunction('.$value->id.')"
                                            style="background-color: #abd373; border: transparent;"
                                            data-tippy="" data-tippy-inertia="true"
                                            data-tippy-animation="shift-away" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                            <i class="pe-7s-cart"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
            $rs .= '
                    </div>
                    <div class="product-content">
                        <a class="product-name"
                            href="'.url('/products').'/'.$value->url.'">'.Helpers::nameFormat($value->name).'</a>
                        <div class="price-box pb-1">
                            <span class="new-price">'.Helpers::currencyFormat($value->price).'</span>
                        </div>
                        <div class="rating-box">
                            <ul>
                                <li><i class="fa fa-star"></i> Đã bán
                                    ('.$value->qty_sold.')</li>
                                '.Helpers::productQuantity($value->qty, $value->qty_sold).'
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $rs;
    }
    // load more data for search results
    public static function searchFunctionLoadMoreData($results)
    {
        $rs = '';
        foreach ($results as $key => $value) {
            $rs .= '
            <div class="sum-div col-xl-3 col-md-4 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="'.url('/products').'/'.$value->url.'">
                            <img style="height: auto;" class="primary-img"
                                src="storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                            <img style="height: auto;" class="secondary-img"
                                src="storage/app/public/images/'.$value->avatar.'" alt="Product Images">
                        </a>';
                        if (($value->qty - $value->qty_sold) > 0) {
                            $rs .= '
                            <div class="product-add-action">
                                <ul>
                                    <li>
                                        <button class="btn btn-primary"
                                            onclick="addToCartFunction('.$value->id.')"
                                            style="background-color: #abd373; border: transparent;"
                                            data-tippy="" data-tippy-inertia="true"
                                            data-tippy-animation="shift-away" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-theme="sharpborder">
                                            <i class="pe-7s-cart"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
            $rs .= '
                    </div>
                    <div class="product-content">
                        <a class="product-name"
                            href="'.url('/products').'/'.$value->url.'">'.Helpers::nameFormat($value->name).'</a>
                        <div class="price-box pb-1">
                            <span class="new-price">'.Helpers::currencyFormat($value->price).'</span>
                        </div>
                        <div class="rating-box">
                            <ul>
                                <li><i class="fa fa-star"></i> Đã bán
                                    ('.$value->qty_sold.')</li>
                                '.Helpers::productQuantity($value->qty, $value->qty_sold).'
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $rs;
    }
}
