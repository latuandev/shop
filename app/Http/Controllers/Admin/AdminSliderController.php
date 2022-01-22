<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminSliderController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productList = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                ->select(
                    'products.id as id',
                    'products.url as url',
                    'products.name as name',
                    'products.code as code',
                    'products.avatar as avatar',
                    'brands.name as brand'
                )
                ->where([['brands.status', 1], ['products.status', 1]])->get();
            return DataTables::of($productList)
                ->addColumn('name', function ($productList) {
                    $name = $productList->name;
                    return $name;
                })
                ->addColumn('avatar', function ($productList) {
                    $avatar = '
                <div class="filtr-item" data-category="1" data-sort="white sample">
                    <a href="../storage/app/public/images/' . $productList->avatar . '"
                        data-toggle="lightbox" data-title="' . $productList->avatar . '">
                        <img src="../storage/app/public/images/' . $productList->avatar . '"
                            class="img-fluid mb-2" alt="white sample" />
                    </a>
                </div>
                ';
                    return $avatar;
                })
                ->addColumn('code', function ($productList) {
                    $code = $productList->code;
                    return $code;
                })
                ->addColumn('brand', function ($productList) {
                    $brand = $productList->brand;
                    return $brand;
                })
                ->addColumn('action', function ($productList) {
                    $sliders = Slider::where('product_url', $productList->url)
                        ->select('id')->get();
                    if ($sliders->isEmpty()) {
                        $status = '
                        <div class="row">
                            <div class="col-8">
                                <span>Đang ẩn slider</span>
                            </div>
                            <div class="col-4" style="text-align: right;">
                                <button onclick="addSliders(' . $productList->id . ')" class="btn btn-primary btn-sm"><i
                                        class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    ';
                    } else {
                        $id = "'" . $productList->url . "'";
                        $status = '
                        <div class="row">
                            <div class="col-8">
                                <span>Đang hiển thị slider</span>
                            </div>
                            <div class="col-4" style="text-align: right;">
                                <button onclick="deleteSliders(' . $id . ')" class="btn btn-primary btn-sm"><i
                                        class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    ';
                    }
                    return $status;
                })
                ->rawColumns(['name', 'avatar', 'code', 'brand', 'action'])
                ->make(true);
        }
        return view('admin.slider.sliders');
    }
    //
    public function add(Request $request)
    {
        if ($request->ajax()) {
            try {
                $getProduct = Product::where('id', $request->id)
                    ->select('url', 'name', 'avatar')->get();
                foreach ($getProduct as $key => $value) {
                    $slider = new Slider();
                    $slider->product_name = $value->name;
                    $slider->product_url = $value->url;
                    $slider->avatar = $value->avatar;
                    $slider->save();
                }
                return response()->json([
                    'pass' => 'Thành công!'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'fail' => $th
                ]);
            }
        }
    }
    //
    public function delete(Request $request)
    {
        if($request->ajax()) {
            try {
                Slider::where('product_url', $request->id)->delete();
                return response()->json([
                    'pass' => 'Thành công!'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'fail' => $th
                ]);
            }
        }
    }
}
