<?php

namespace App\Http\Controllers\User;

use App\Brand;
use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class UserBrandController extends Controller
{
    //
    public function index(Request $request)
    {
        // show session for all products as categories
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold',
                'brands.name as brand_name'
            )
            ->where([
                ['brands.status', 1],
                ['products.status', 1],
                ['brands.url', '=', $request->url]
            ])
            ->orderBy('products.name', 'asc')->take(6)->get();
        $newProduct = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([['brands.status', 1], ['products.status', 1]])
            ->latest('products.created_at')->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar'
            )->limit(1)->get();
        // show products as selected option
        if ($request->ajax()) {
            if ($request->selectId == 1) {
                // sort as name a-z
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold',
                        'brands.name as brand_name'
                    )
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['brands.url', '=', $request->url]
                    ])->orderBy('products.name', 'asc')->take(6)->get();
                $rs = Helpers::products($products);
                return response()->json($rs);
            } else if ($request->selectId == 2) {
                // sort as quantity sold
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold',
                        'brands.name as brand_name'
                    )
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['brands.url', '=', $request->url]
                    ])->orderBy('products.qty_sold', 'desc')->take(6)->get();
                $rs = Helpers::products($products);
                return response()->json($rs);
            } else if ($request->selectId == 3) {
                // sort as price from low to high
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold',
                        'brands.name as brand_name'
                    )
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['brands.url', '=', $request->url]
                    ])->orderBy('products.price', 'asc')->take(6)->get();
                $rs = Helpers::products($products);
                return response()->json($rs);
            } else if ($request->selectId == 4) {
                // sort as price from high to low
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold',
                        'brands.name as brand_name'
                    )
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['brands.url', '=', $request->url]
                    ])->orderBy('products.price', 'desc')->take(6)->get();
                $rs = Helpers::products($products);
                return response()->json($rs);
            }
        }
        $sumProducts = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([
                ['brands.status', 1],
                ['products.status', 1],
                ['brands.url', '=', $request->url]
            ])->count();
        return view('user.brand.brands', compact('products', 'newProduct', 'sumProducts'));
    }
    //
    public function loadMoreData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->selectId == 1) {
                // load more for a-z sort session
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.id as id',
                    'products.url as url',
                    'products.name as name',
                    'products.avatar as avatar',
                    'products.price as price',
                    'products.qty as qty',
                    'products.qty_sold as qty_sold',
                    'brands.name as brand_name'
                )
                ->where([
                    ['brands.status', 1],
                    ['products.status', 1],
                    ['brands.url', '=', $request->url]
                ])->orderBy('products.name', 'asc')->skip($request->skip)->take(6)->get();
                $rs = Helpers::loadMoreProducts($products);
                return response()->json($rs);
            } else if ($request->selectId == 2) {
                // load more for quantity sold sort session
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.id as id',
                    'products.url as url',
                    'products.name as name',
                    'products.avatar as avatar',
                    'products.price as price',
                    'products.qty as qty',
                    'products.qty_sold as qty_sold',
                    'brands.name as brand_name'
                )
                ->where([
                    ['brands.status', 1],
                    ['products.status', 1],
                    ['brands.url', '=', $request->url]
                ])->orderBy('products.qty_sold', 'desc')->skip($request->skip)->take(6)->get();
                $rs = Helpers::loadMoreProducts($products);
                return response()->json($rs);
            } else if ($request->selectId == 3) {
                //  load more for price from low to high sort session
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.id as id',
                    'products.url as url',
                    'products.name as name',
                    'products.avatar as avatar',
                    'products.price as price',
                    'products.qty as qty',
                    'products.qty_sold as qty_sold',
                    'brands.name as brand_name'
                )
                ->where([
                    ['brands.status', 1],
                    ['products.status', 1],
                    ['brands.url', '=', $request->url]
                ])->orderBy('products.price', 'asc')->skip($request->skip)->take(6)->get();
                $rs = Helpers::loadMoreProducts($products);
                return response()->json($rs);
            } else if ($request->selectId == 4) {
                // load more for price from high to low sort session
                $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.id as id',
                    'products.url as url',
                    'products.name as name',
                    'products.avatar as avatar',
                    'products.price as price',
                    'products.qty as qty',
                    'products.qty_sold as qty_sold',
                    'brands.name as brand_name'
                )
                ->where([
                    ['brands.status', 1],
                    ['products.status', 1],
                    ['brands.url', '=', $request->url]
                ])->orderBy('products.price', 'desc')->skip($request->skip)->take(6)->get();
                $rs = Helpers::loadMoreProducts($products);
                return response()->json($rs);
            }
        }
    }
}
