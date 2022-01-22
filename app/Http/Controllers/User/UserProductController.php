<?php

namespace App\Http\Controllers\User;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $productDetails = Product::join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.url', $request->url)
        ->select(
            'products.id as id',
            'products.name as name',
            'products.code as code',
            'products.avatar as avatar',
            'products.color as color',
            'products.desc as desc',
            'products.price as price',
            'products.qty as qty',
            'products.qty_sold as qty_sold',
            'products.category_id as category_id',
            'brands.name as brand',
            'categories.name as category'
        )->get();
        $galleries = Gallery::where('product_url', $request->url)
        ->select('image')->get();
        foreach ($productDetails as $key => $value) {
            $relatedProducts = Product::where([['status', 1], ['category_id', $value->category_id]])
            ->select('id', 'url', 'name', 'avatar', 'price', 'qty', 'qty_sold')->get();
        }
        return view('user.product.products', compact('productDetails', 'galleries', 'relatedProducts'));
    }
}
