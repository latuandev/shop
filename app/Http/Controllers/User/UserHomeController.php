<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    //
    public function index()
    {
        $featuredProducts = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([['brands.status', 1], ['products.status', 1]])
            ->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold'
            )->orderBy('name', 'asc')->limit(12)->get();
        $bestSellerProducts = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([['brands.status', 1], ['products.status', 1]])
            ->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold'
            )->orderBy('qty_sold', 'desc')->where('qty_sold', '>', 0)->limit(8)->get();
        $latestProducts = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([['brands.status', 1], ['products.status', 1]])
            ->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold'
            )->latest('products.created_at')->limit(8)->get();
        $sliders = Slider::select('product_name', 'product_url', 'avatar')->get();
        return view('user.home.home', compact('featuredProducts', 'bestSellerProducts', 'latestProducts', 'sliders'));
    }
}
