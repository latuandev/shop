<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class AdminProductController extends Controller
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
                    'products.color as color',
                    'products.price as price',
                    'products.status as status',
                    'brands.name as brand'
                )
                ->get();
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
                ->addColumn('price', function ($productList) {
                    $price = Helpers::currencyFormat($productList->price);
                    return $price;
                })
                ->addColumn('color', function ($productList) {
                    $color = $productList->color;
                    return $color;
                })
                ->addColumn('status', function ($productList) {
                    if ($productList->status == 0) {
                        $status = '
                    <div class="row">
                        <div class="col-6">
                            <span>Ẩn</span>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <button onclick="changeFunction(' . $productList->id . ', ' . $productList->status . ')" class="btn btn-primary btn-sm"><i
                                    class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    ';
                    } else {
                        $status = '
                    <div class="row">
                        <div class="mr-2">
                            <span>Hiển thị</span>
                        </div>
                        <div class="" style="text-align: right;">
                            <button onclick="changeFunction(' . $productList->id . ', ' . $productList->status . ')" class="btn btn-primary btn-sm"><i
                                    class="fas fa-eye-slash"></i></button>
                        </div>
                    </div>
                    ';
                    }
                    return $status;
                })
                ->addColumn('action', function ($productList) {
                    $id = "'" . $productList->url . "'";
                    $btn = '
                    <a href="' . url('/admin/products') . '/' . $productList->url . '"
                    ><button class="btn btn-block btn-info btn-sm">Chi tiết</button></a>
                    <button class="btn btn-block btn-danger btn-sm"
                    onclick="deleteFunction(' . $id . ')">Xóa</button>
                ';
                    return $btn;
                })
                ->rawColumns(['name', 'avatar', 'code', 'brand', 'price', 'color', 'status', 'action'])
                ->make(true);
        }
        return view('admin.product.products');
    }
    //
    public function addView(Request $request)
    {
        return view('admin.product.add-view');
    }
    //
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required | max: 255',
                'code' => 'required',
                'brand' => 'required',
                'color' => 'required',
                'price' => 'required | integer',
                'qty' => 'required',
                'category' => 'required'
            ], [
                'name.required' => 'Vui lòng nhập tên sản phẩm!',
                'name.max' => 'Tên quá dài!',
                'code.required' => 'Vui lòng nhập mã sản phẩm!',
                'brand.required' => 'Vui lòng chọn nhãn hiệu sản phẩm!',
                'price.required' => 'Vui lòng nhập giá sản phẩm!',
                'price.integer' => 'Giá sản phẩm phải là 1 số nguyên!',
                'color.required' => 'Vui lòng nhập màu sản phẩm!',
                'qty.required' => 'Vui lòng cho biết số lượng hàng nhập về kho!',
                'category.required' => 'Vui lòng chọn chuyên mục!'
            ]);
            if ($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $codeExisted = Product::where('code', $request->code)->first();
                if ($codeExisted) {
                    return response()->json([
                        'fail' => 'Đã có mã sản phẩm này!'
                    ]);
                } else {
                    try {
                        if ($request->hasFile('avatar')) {
                            // session for product
                            $random = Str::random(10);
                            $avatarName = $random . '_' . $request->file('avatar')->getClientOriginalName();
                            $request->file('avatar')->storeAs('images/', $avatarName, 'public');
                            $product = new Product();
                            $product->url = Str::slug($request->name);
                            $product->name = ucfirst($request->name);
                            $product->code = $request->code;
                            $product->avatar = $avatarName;
                            $product->color = ucfirst($request->color);
                            $product->desc = $request->desc;
                            $product->price = $request->price;
                            $product->qty = $request->qty;
                            $product->qty_sold = 0;
                            if (isset($request->cbHide)) {
                                $product->status = 0;
                            } else {
                                $product->status = 1;
                            }
                            $product->brand_id = $request->brand_id;
                            $product->category_id = $request->category_id;
                            $product->save();
                            // session for gallery
                            if ($request->hasFile('gallery')) {
                                foreach ($request->file('gallery') as $key => $value) {
                                    $galleryName = $random . '_' . $value->getClientOriginalName();
                                    $value->storeAs('/images', $galleryName, 'public');
                                    $gallery = new Gallery();
                                    $gallery->image = $galleryName;
                                    $gallery->product_url = Str::slug($request->name);
                                    $gallery->save();
                                }
                            }
                            return response()->json([
                                'pass' => 'Thành công!'
                            ]);
                        } else {
                            return response()->json([
                                'fail' => 'Vui lòng chọn ảnh sản phẩm!'
                            ]);
                        }
                    } catch (\Throwable $th) {
                        return response()->json([
                            'fail' => $th
                        ]);
                    }
                }
            }
        }
    }
    //
    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            try {
                if ($request->status == 0) {
                    Product::where('id', $request->id)->update(['status' => 1]);
                } else {
                    Product::where('id', $request->id)->update(['status' => 0]);
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
        if ($request->ajax()) {
            try {
                // delete product image gallery
                $gallery = Gallery::where('product_url', $request->url)->get();
                foreach ($gallery as $key => $value) {
                    Storage::disk('public')->delete('images/' . $value->image);
                }
                Gallery::where('product_url', $request->url)->delete();
                //
                $product = Product::where('url', $request->url)->select('avatar')->get();
                foreach ($product as $key => $value) {
                    Storage::disk('public')->delete('images/' . $value->avatar);
                }
                Product::where('url', $request->url)->delete();
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
    public function productDetails(Request $request)
    {
        $productDetails = Product::where('products.url', $request->url)
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.*',
                'brands.id as brand_id',
                'brands.name as brand',
                'categories.id as category_id',
                'categories.name as category'
            )->get();
        $galleries = Gallery::where('product_url', $request->url)->select('product_url', 'image')->get();
        return view('admin.product.product-details', compact('productDetails', 'galleries'));
    }
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required',
                'color' => 'required',
                'price' => 'required',
                'qty' => 'required'
            ], [
                'name.required' => 'Vui lòng nhập tên sản phẩm!',
                'price.required' => 'Vui lòng nhập giá sản phẩm!',
                'color.required' => 'Vui lòng nhập màu sản phẩm!',
                'qty.required' => 'Vui lòng cho biết số lượng hàng nhập về kho!'
            ]);
            if ($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                try {
                    // get product id
                    $productId = Product::where('url', $request->url)->select('id')->get();
                    foreach ($productId as $key => $value) {
                        $id = $value->id;
                    }
                    //
                    Product::where('id', $id)->update([
                        'url' => Str::slug($request->name),
                        'name' => ucfirst($request->name),
                        'color' => ucfirst($request->color),
                        'desc' => $request->desc,
                        'price' => $request->price,
                        'qty' => $request->qty,
                        'brand_id' => $request->brand_id,
                        'category_id' => $request->category_id
                    ]);
                    if (isset($request->cbHide)) {
                        Product::where('id', $id)->update(['status' => 0]);
                    } else {
                        Product::where('id', $id)->update(['status' => 1]);
                    }
                    //
                    $random = Str::random(10);
                    if ($request->hasFile('avatar')) {
                        // remove old file avatar form storage
                        $oldFile = Product::where('id', $id)
                            ->select('avatar')->get();
                        foreach ($oldFile as $key => $value) {
                            Storage::disk('public')->delete('images/' . $value->avatar);
                        }
                        // save new file avatar
                        $avatarName = $random . '_' . $request->file('avatar')->getClientOriginalName();
                        $request->file('avatar')->storeAs('images/', $avatarName, 'public');
                        Product::where('id', $id)->update(['avatar' => $avatarName]);
                    }
                    // session for gallery
                    if ($request->hasFile('gallery')) {
                        // save new file gallery
                        foreach ($request->file('gallery') as $key => $value3) {
                            $galleryName = $random . '_' . $value3->getClientOriginalName();
                            $value3->storeAs('/images', $galleryName, 'public');
                            $gallery = new Gallery();
                            $gallery->image = $galleryName;
                            $gallery->product_url = Str::slug($request->name);
                            $gallery->save();
                        }
                    }
                    Gallery::where('product_url', $request->url)->update(['product_url' => Str::slug($request->name)]);
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
    //
    public function deleteGalleries(Request $request)
    {
        if ($request->ajax()) {
            try {
                // delete files storage
                $gallery = Gallery::where('product_url', $request->url)->get();
                foreach ($gallery as $key => $value) {
                    Storage::disk('public')->delete('images/' . $value->image);
                }
                // delete in database
                Gallery::where('product_url', $request->url)->delete();
                return response()->json([
                    'pass' => 'Xóa thư viện ảnh thành công!'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'fail' => $th
                ]);
            }
        }
    }
}
