<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationForCanceledOrder;
use App\Jobs\SendNotificationForConfirmedOrder;
use App\Order;
use App\OrderDetails;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminOrderController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax()) {
            $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.code as code',
                'orders.product_total as product_total',
                'orders.total as total',
                'orders.status as status',
                'users.name as user_name'
            )->orderBy('orders.status', 'asc')->get();
            return DataTables::of($orders)
            ->addColumn('code', function ($orders) {
                return $orders->code;
            })->addColumn('user_name', function($orders) {
                return $orders->user_name;
            })->addColumn('total', function($orders) {
                return Helpers::currencyFormat($orders->total).' của '.$orders->product_total.' sản phẩm ';
            })->addColumn('status', function($orders) {
                if($orders->status == 1) {
                    return '<span style="color: gray;">Đang chờ xác nhận</span>';
                } else if($orders->status == 2) {
                    return '<span style="color: #8a6d3b;">Đang vận chuyển</span>';
                } else if($orders->status == 3) {
                    return '<span style="color: #abd373;">Đã giao hàng</span>';
                } else if($orders->status == 4) {
                    return '<span style="color: #a94442;">Đã hủy</span>';
                }
            })->addColumn('option', function($orders) {
                $btn = '
                <a href="' . url('/admin/orders') . '/' . $orders->code . '"
                    ><button class="btn btn-block btn-info btn-sm">Chi tiết</button></a>
                ';
                return $btn;
            })->rawColumns(['code', 'user_name', 'total', 'status', 'option'])->make(true);
        }
        return view('admin.order.orders');
    }
    //
    public function orderDetails(Request $request)
    {
        $details = OrderDetails::join('products', 'order_details.product_url', '=', 'products.url')
        ->join('orders', 'order_details.order_code', '=', 'orders.code')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('shippeds', 'orders.ship_id', '=', 'shippeds.id')
        ->where('order_details.order_code', $request->code)
        ->select(
            'order_details.product_url as url',
            'order_details.product_avatar as avatar',
            'order_details.product_name as name',
            'order_details.product_price as price',
            'order_details.product_qty as orders_qty',
            'products.qty as product_qty',
            'products.qty_sold as product_qty_sold',
            'orders.total as total',
            'orders.coupons as coupons',
            'orders.status as status',
            'users.email as user_email',
            'users.name as user_name',
            'users.phone as user_phone',
            'shippeds.provice as provice',
            'shippeds.district as district',
            'shippeds.street as street'
        )->get();
        return view('admin.order.order-details', compact('details'));
    }
    //
    public function confirmOrder(Request $request)
    {
        if($request->ajax()) {
            Order::where('code', $request->code)->update(['status' => 2]);
            //
            $orderDetails = OrderDetails::join('orders', 'order_details.order_code', '=', 'orders.code')
            ->select(
                'order_details.product_url as url',
                'order_details.product_qty as qty'
            )->where('order_details.order_code', $request->code)->get();
            // plus the number of products sold
            foreach ($orderDetails as $key => $value) {
                $qtySold = Product::where('url', $value->url)->select('qty_sold')->get();
                $newQtySold = $qtySold[0]->qty_sold + $value->qty;
                Product::where('url', $value->url)->update(['qty_sold' => $newQtySold]);
            }
            //
            $user = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.code', $request->code)
            ->select('users.name', 'users.email', 'orders.code')->get();
            $data = array(
                'name' => $user[0]->name,
                'email' => $user[0]->email,
                'order_code' => $user[0]->code
            );
            dispatch(new SendNotificationForConfirmedOrder($data));
            return response()->json('Thành công!');
        }
    }
    //
    public function delivered(Request $request)
    {
        if($request->ajax()) {
            Order::where('code', $request->code)->update(['status' => 3]);
            return response()->json('Thành công!');
        }
    }
    //
    public function cancelOrder(Request $request)
    {
        if($request->ajax()) {
            Order::where('code', $request->code)->update(['status' => 4]);
            //
            $orderDetails = OrderDetails::join('orders', 'order_details.order_code', '=', 'orders.code')
            ->select(
                'order_details.product_url as url',
                'order_details.product_qty as qty'
            )->where('order_details.order_code', $request->code)->get();
            // minus the number of products sold
            foreach ($orderDetails as $key => $value) {
                $qtySold = Product::where('url', $value->url)->select('qty_sold')->get();
                $newQtySold = $qtySold[0]->qty_sold - $value->qty;
                Product::where('url', $value->url)->update(['qty_sold' => $newQtySold]);
            }
            //
            $user = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.code', $request->code)
            ->select('users.name', 'users.email', 'orders.code')->get();
            $data = array(
                'name' => $user[0]->name,
                'email' => $user[0]->email,
                'order_code' => $user[0]->code,
                'reason' => $request->reason
            );
            dispatch(new SendNotificationForCanceledOrder($data));
            return response()->json('Thành công!');
        }
    }
}
