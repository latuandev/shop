<?php

namespace App\Http\Controllers\User;

use App\Coupons;
use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailForNewOrder;
use App\Order;
use App\OrderDetails;
use App\Product;
use App\Shipped;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserCartController extends Controller
{
    //
    public function index()
    {
        $suggestedProducts = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->where([['brands.status', 1], ['products.status', 1]])
            ->select(
                'products.id as id',
                'products.url as url',
                'products.name as name',
                'products.avatar as avatar',
                'products.price as price',
                'products.qty as qty',
                'products.qty_sold as qty_sold'
            )->limit(10)->get();
        return view('user.cart.cart', compact('suggestedProducts'));
    }
    //
    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::where('id', $request->id)
                ->select('id', 'url', 'name', 'avatar', 'price')->get();
            foreach ($product as $key => $value) {
                // add to cart with custom product quantity, this's for product details page
                if (isset($request->qty)) {
                    Cart::add([
                        'id' => $value->id,
                        'name' => $value->name,
                        'qty' => $request->qty,
                        'price' => $value->price,
                        'weight' => 0,
                        'options' => ['url' => $value->url, 'avatar' => $value->avatar]
                    ]);
                } else {
                    // default product quantity as 1, this's for quick-add
                    Cart::add([
                        'id' => $value->id,
                        'name' => $value->name,
                        'qty' => 1,
                        'price' => $value->price,
                        'weight' => 0,
                        'options' => ['url' => $value->url, 'avatar' => $value->avatar]
                    ]);
                }
            }
            return response()->json('Thành công!');
        }
    }
    //
    public function removeProductFromCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::remove($request->id);
            return response()->json('Thành công!');
        }
    }
    //
    public function updateCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::update($request->rowId, $request->qty);
            return response()->json('Thành công!');
        }
    }
    //
    public function removeCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::destroy();
            return response()->json('Thành công!');
        }
    }
    // checkout
    public function checkoutView()
    {
        $ship = Shipped::where('user_id', Auth::id())
            ->select('id', 'provice', 'district', 'street')->get();
        return view('user.cart.checkout', compact('ship'));
    }
    //
    public function checkoutConfirm(Request $request)
    {
        if ($request->ajax()) {
            // session for new shipping address
            if ($request->shipped == 0) {
                $vali = Validator::make($request->all(), [
                    'provice' => 'required',
                    'district' => 'required',
                    'street' => 'required',
                    'phone' => 'required'
                ], [
                    'provice.required' => 'Vui lòng nhập thông tin Tỉnh/Thành phố!',
                    'district.required' => 'Vui lòng nhập thông tin Quận/Huyện!',
                    'street.required' => 'Vui lòng nhập thông tin Số nhà/Đường phố!',
                    'phone.required' => 'Vui lòng nhập số điện thoại!'
                ]);
                if ($vali->fails()) {
                    return response()->json([
                        'fail' => $vali->errors()->first()
                    ]);
                } else {
                    // session for new shipping
                    $code = 'DH-' . Str::random(10);
                    // check order code exists
                    $codeExisted = Order::where('code', $code)->first();
                    if($codeExisted) {
                        // reassign value to "code" variable
                        $code = 'DH-' . Str::random(10);
                    }
                    // tbl_users
                    User::where('id', Auth::id())->update(['phone' => $request->phone]);
                    // tbl_shipped
                    $newShip = new Shipped();
                    $newShip->ship_code = $code;
                    $newShip->provice = $request->provice;
                    $newShip->district = $request->district;
                    $newShip->street = $request->street;
                    $newShip->user_id = Auth::id();
                    $newShip->save();
                    // get shipped id
                    $shipId = Shipped::where('ship_code', $code)
                    ->select('id')->get();
                    // tbl_order
                    $newOrder = new Order();
                    $newOrder->code = $code;
                    $newOrder->product_total = Cart::count();
                    $newOrder->total = $request->total;
                    $newOrder->coupons = $request->coupons;
                    $newOrder->status = 1;
                    $newOrder->user_id = Auth::id();
                    $newOrder->ship_id = $shipId[0]->id;
                    $newOrder->note = $request->note;
                    $newOrder->save();
                    // tbl_order_details
                    foreach (Cart::content() as $key => $value) {
                        $newOrderDetails = new OrderDetails();
                        $newOrderDetails->product_url = $value->options['url'];
                        $newOrderDetails->product_avatar = $value->options['avatar'];
                        $newOrderDetails->product_name = $value->name;
                        $newOrderDetails->product_price = $value->price;
                        $newOrderDetails->product_qty = $value->qty;
                        $newOrderDetails->order_code = $code;
                        $newOrderDetails->save();
                    }
                    // session for send notification
                    $admin = User::where('role', 1)->select('name', 'email')->get();
                    $data = array(
                        'email' => $admin[0]->email,
                        'name' => $admin[0]->name,
                        'user_name' => Auth::user()->name
                    );
                    dispatch(new SendEmailForNewOrder($data));
                    Cart::destroy();
                    return response()->json([
                        'pass' => 'Đặt hàng thành công!'
                    ]);
                }
            } else {
                // session for shipping address exists
                // tbl_order
                $code = 'DH-' . Str::random(10);
                // check order code exists
                $codeExisted = Order::where('code', $code)->first();
                if($codeExisted) {
                    // reassign value to "code" variable
                    $code = 'DH-' . Str::random(10);
                }
                $newOrder = new Order();
                $newOrder->code = $code;
                $newOrder->product_total = Cart::count();
                $newOrder->total = $request->total;
                $newOrder->coupons = $request->coupons;
                $newOrder->status = 1;
                $newOrder->user_id = Auth::id();
                $newOrder->ship_id = $request->shipped;
                $newOrder->note = $request->note;
                $newOrder->save();
                // tbl_order_details
                foreach (Cart::content() as $key => $value) {
                    $newOrderDetails = new OrderDetails();
                    $newOrderDetails->product_url = $value->options['url'];
                    $newOrderDetails->product_avatar = $value->options['avatar'];
                    $newOrderDetails->product_name = $value->name;
                    $newOrderDetails->product_price = $value->price;
                    $newOrderDetails->product_qty = $value->qty;
                    $newOrderDetails->order_code = $code;
                    $newOrderDetails->save();
                }
                // session for send notification
                $admin = User::where('role', 1)->select('name', 'email')->get();
                $data = array(
                    'email' => $admin[0]->email,
                    'name' => $admin[0]->name,
                    'user_name' => Auth::user()->name
                );
                dispatch(new SendEmailForNewOrder($data));
                Cart::destroy();
                return response()->json([
                    'pass' => 'Đặt hàng thành công!'
                ]);
            }
        }
    }
    //
    public function couponsApplied(Request $request) {
        if($request->ajax()){
            $vali = Validator::make($request->all(), [
                'coupons' => 'required'
            ], [
                'coupons.required' => 'Nhập mã giảm giá!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $couponsExisted = Coupons::where('code', $request->coupons)
                ->select('offer', 'expiry')->get();
                if(!$couponsExisted->isEmpty()){
                    $currentDate = date('Y-m-d');
                    if($currentDate > $couponsExisted[0]->expiry) {
                        return response()->json([
                            'fail' => 'Mã giảm giá đã hết hạn sử dụng!'
                        ]);
                    } else {
                        $total = Cart::subtotal()*(100-$couponsExisted[0]->offer)/100;
                        $result1 = '
                        <th>Giảm giá</th>
                        <td><span class="amount">'.$couponsExisted[0]->offer.'%</span></td>
                        ';
                        $result2 = '
                        <th>Tổng tiền cần trả</th>
                        <td><strong><span class="amount">'.Helpers::currencyFormat($total).'</span></strong></td>
                        <input type="hidden" id="hd-total" value="'.$total.'">
                        <input type="hidden" id="hd-coupons" value="'.$couponsExisted[0]->offer.'">
                        ';
                        return response()->json([
                            'pass' => 'Thành công!',
                            'coupons' => $result1,
                            'total' => $result2
                        ]);
                    }
                } else {
                    return response()->json([
                        'fail' => 'Không có mã giảm giá này!'
                    ]);
                }
            }
        }
    }
}
