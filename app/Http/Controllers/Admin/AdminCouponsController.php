<?php

namespace App\Http\Controllers\Admin;

use App\Coupons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class AdminCouponsController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupons::latest()->select('id', 'name', 'code', 'expiry', 'offer')
                ->get();
            return DataTables::of($coupons)
                ->addColumn('name', function ($coupons) {
                    $name = $coupons->name;
                    return $name;
                })
                ->addColumn('code', function ($coupons) {
                    $code = $coupons->code;
                    return $code;
                })
                ->addColumn('offer', function ($coupons) {
                    $offer = $coupons->offer;
                    return $offer;
                })
                ->addColumn('expiry', function ($coupons) {
                    $expiry = strtotime($coupons->expiry);
                    return date("d-m-Y", $expiry);
                })
                ->addColumn('action', function ($coupons) {
                    $btn = '
                <button class="btn btn-block btn-danger btn-sm"
                onclick="deleteFunction(' . $coupons->id . ')">Xóa</button>
            ';
                    return $btn;
                })->rawColumns(['name', 'code', 'expiry', 'offer', 'action'])->make(true);
        }
        return view('admin.coupons.coupons');
    }
    //
    //
    public function add(Request $request)
    {
        if($request->ajax()){
            $vali = Validator::make($request->all(), [
                'name' => 'required',
                'offer' => 'required | integer',
                'expiry' => 'required'
            ], [
                'name.required' => 'Vui lòng nhập tên mã giảm giá!',
                'offer.required' => 'Vui lòng nhập % giảm giá!',
                'offer.integer' => '% giảm giá phải là 1 số nguyên!',
                'expiry.required' => 'Hạng dùng là bắt buộc và phải lớn hơn ngày hiện tại!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $code = Str::random(6);
                $expiry = strtotime($request->expiry);
                $create = new Coupons();
                $create->name = ucfirst($request->name);
                $create->code = $code;
                $create->expiry = date('Y-m-d', $expiry);
                $create->offer = $request->offer;
                $create->save();
                return response()->json([
                    'pass' => 'Thành công!'
                ]);
            }
        }
    }
    public function delete(Request $request)
    {
        if($request->ajax()) {
            try {
                Coupons::where('id', $request->id)->delete();
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
