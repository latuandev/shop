<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([
                ['brands.status', 1],
                ['products.status', 1],
                ['products.name', 'LIKE', '%' . $request->key . '%']
            ])->orWhere([
                ['brands.status', 1],
                ['products.status', 1],
                ['products.code', 'LIKE', '%' . $request->key . '%']
            ])->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold'
            )->orderBy('products.name', 'asc')->take(12)->get();
        if ($request->ajax()) {
            if ($request->selectId == 1) {
                // sort by a-z name
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.name', 'asc')->take(12)->get();
                $rs = Helpers::searchData($results);
                return response()->json($rs);
            } else if ($request->selectId == 2) {
                // sort by price from low to high
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.price', 'asc')->take(12)->get();
                $rs = Helpers::searchData($results);
                return response()->json($rs);
            } else if ($request->selectId == 3) {
                // sort by price from high to low
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.price', 'desc')->take(12)->get();
                $rs = Helpers::searchData($results);
                return response()->json($rs);
            }
        }
        return view('user.search.search', compact('results'));
    }
    //
    public function loadMoreData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->selectId == 1) {
                // sort by default a-z name
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.name', 'asc')->skip($request->skip)->take(12)->get();
                $rs = Helpers::searchFunctionLoadMoreData($results);
                return response()->json($rs);
            } else if ($request->selectId == 2) {
                // sort by price from low to high
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.price', 'asc')->skip($request->skip)->take(12)->get();
                $rs = Helpers::searchFunctionLoadMoreData($results);
                return response()->json($rs);
            } else if ($request->selectId == 3) {

                // sort by price from high to low
                $results = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.name', 'LIKE', '%' . $request->key . '%']
                    ])->orWhere([
                        ['brands.status', 1],
                        ['products.status', 1],
                        ['products.code', 'LIKE', '%' . $request->key . '%']
                    ])->select(
                        'products.id as id',
                        'products.url as url',
                        'products.name as name',
                        'products.avatar as avatar',
                        'products.price as price',
                        'products.qty as qty',
                        'products.qty_sold as qty_sold'
                    )->orderBy('products.price', 'desc')->skip($request->skip)->take(12)->get();
                $rs = Helpers::searchFunctionLoadMoreData($results);
                return response()->json($rs);
            }
        }
    }
}
