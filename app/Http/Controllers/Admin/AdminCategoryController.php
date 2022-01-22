<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categoryList = Category::latest()
            ->select('id', 'name', 'status', 'created_at')->get();
            return DataTables::of($categoryList)
                ->addColumn('name', function ($categoryList) {
                    $name = $categoryList->name;
                    return $name;
                })
                ->addColumn('status', function ($categoryList) {
                    if ($categoryList->status == 0) {
                        $status = '
                    <div class="row">
                        <div class="col-6">
                            <span>Ẩn</span>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <button onclick="changeFunction(' . $categoryList->id . ', ' . $categoryList->status . ')" class="btn btn-primary btn-sm"><i
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
                            <button onclick="changeFunction(' . $categoryList->id . ', ' . $categoryList->status . ')" class="btn btn-primary btn-sm"><i
                                    class="fas fa-eye-slash"></i></button>
                        </div>
                    </div>
                    ';
                    }
                    return $status;
                })
                ->addColumn('date', function ($categoryList) {
                    $date = Helpers::timestampFormat($categoryList->created_at);
                    return $date;
                })
                ->addColumn('action', function ($categoryList) {
                    $btn = '
                <button class="btn btn-block btn-danger btn-sm"
                    onclick="deleteFunction(' . $categoryList->id . ')">Xóa</button>
                ';
                    return $btn;
                })
                ->rawColumns(['name', 'status', 'date', 'action'])->make(true);
        }
        return view('admin.category.categories');
    }
    //
    public function add(Request $request)
    {
        if($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required'
            ], [
                'name.required' => 'Vui lòng nhập tên chuyên mục!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                try {
                    $categoryExisted = Category::where('name', $request->name)->first();
                    if($categoryExisted) {
                        return response()->json([
                            'fail' => 'Đã có tên chuyên mục này!'
                        ]);
                    } else {
                        $category = new Category();
                        $category->url = Str::slug($request->name);
                        $category->name = ucfirst($request->name);
                        if(isset($request->cbHide)) {
                            $category->status = 0;
                        } else {
                            $category->status = 1;
                        }
                        $category->save();
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
    //
    public function changeStatus(Request $request)
    {
        if($request->ajax()) {
            try {
                if($request->status == 0) {
                    Category::where('id', $request->id)->update(['status' => 1]);
                } else {
                    Category::where('id', $request->id)->update(['status' => 0]);
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
                // return all category_id to 0
                $productExisted = Product::where('category_id', $request->id)
                ->select('category_id')->get();
                foreach ($productExisted as $key => $value) {
                    Product::where('category_id', $request->id)->update(['category_id' => 0]);
                }
                Category::where('id', $request->id)->delete();
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
