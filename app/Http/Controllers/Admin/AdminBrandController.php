<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Helper\Helper;
use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class AdminBrandController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brandList = Brand::latest()
                ->select('id', 'name', 'status', 'created_at')->get();
            return DataTables::of($brandList)
                ->addColumn('name', function ($brandList) {
                    $name = $brandList->name;
                    return $name;
                })
                ->addColumn('status', function ($brandList) {
                    if ($brandList->status == 0) {
                        $status = '
                        <div class="row">
                            <div class="col-6">
                                <span>Ẩn</span>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <button onclick="changeFunction(' . $brandList->id . ', ' . $brandList->status . ')" class="btn btn-primary btn-sm"><i
                                        class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    ';
                    } else {
                        $status = '
                        <div class="row">
                            <div class="col-6">
                                <span>Hiển thị</span>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <button onclick="changeFunction(' . $brandList->id . ', ' . $brandList->status . ')" class="btn btn-primary btn-sm"><i
                                        class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    ';
                    }
                    return $status;
                })
                ->addColumn('date', function ($brandList) {
                    $date = '
                    ' . Helpers::timestampFormat($brandList->created_at) . '
                ';
                    return $date;
                })
                ->addColumn('action', function ($brandList) {
                    $btn = '
                    <button class="btn btn-block btn-danger btn-sm"
                    onclick="deleteFunction(' . $brandList->id . ')">Xóa</button>
                ';
                    return $btn;
                })->rawColumns(['name', 'status', 'date', 'action'])->make(true);
        }
        return view('admin.brand.brands');
    }
    //
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required'
            ], [
                'name.required' => 'Vui lòng nhập tên nhà cung cấp!'
            ]);
            if ($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                // check name brand
                $brandExisted = Brand::where('name', $request->name)->first();
                if ($brandExisted) {
                    return response()->json([
                        'fail' => 'Đã có tên nhà cung cấp này!'
                    ]);
                } else {
                    try {
                        $brand = new Brand();
                        $brand->url = Str::slug($request->name);
                        $brand->name = ucfirst($request->name);
                        if (isset($request->cbHide)) {
                            $brand->status = 0;
                        } else {
                            $brand->status = 1;
                        }
                        $brand->save();
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
    }
    //
    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            try {
                if ($request->status == 0) {
                    Brand::where('id', $request->id)->update(['status' => 1]);
                } else {
                    Brand::where('id', $request->id)->update(['status' => 0]);
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
                $productExisted = Product::where('brand_id', $request->id)
                    ->select('*')->first();
                if ($productExisted) {
                    return response()->json([
                        'warning' => 'Bạn không thể xóa nhà cung cấp này vì dữ liệu sản phẩm của họ vẫn tồn tại.<br>
                        Bạn có thể dùng chức năng "Ẩn nhà cung cấp".<br>
                        Nếu vẫn muốn xóa, trước tiên bạn phải làm sạch dữ liệu sản phẩm của nhà cung cấp này!'
                    ]);
                } else {
                    Brand::where('id', $request->id)->delete();
                    return response()->json([
                        'pass' => 'Thành công!'
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
