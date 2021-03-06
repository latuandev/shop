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
            return response()->json('Th??nh c??ng!');
        }
    }
    //
    public function removeProductFromCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::remove($request->id);
            return response()->json('Th??nh c??ng!');
        }
    }
    //
    public function updateCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::update($request->rowId, $request->qty);
            return response()->json('Th??nh c??ng!');
        }
    }
    //
    public function removeCart(Request $request)
    {
        if ($request->ajax()) {
            Cart::destroy();
            return response()->json('Th??nh c??ng!');
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
                    'provice.required' => 'Vui l??ng nh???p th??ng tin T???nh/Th??nh ph???!',
                    'district.required' => 'Vui l??ng nh???p th??ng tin Qu???n/Huy???n!',
                    'street.required' => 'Vui l??ng nh???p th??ng tin S??? nh??/???????ng ph???!',
                    'phone.required' => 'Vui l??ng nh???p s??? ??i???n tho???i!'
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
                        'pass' => '?????t h??ng th??nh c??ng!'
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
                    'pass' => '?????t h??ng th??nh c??ng!'
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
                'coupons.required' => 'Nh???p m?? gi???m gi??!'
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
                            'fail' => 'M?? gi???m gi?? ???? h???t h???n s??? d???ng!'
                        ]);
                    } else {
                        $total = Cart::subtotal()*(100-$couponsExisted[0]->offer)/100;
                        $result1 = '
                        <th>Gi???m gi??</th>
                        <td><span class="amount">'.$couponsExisted[0]->offer.'%</span></td>
                        ';
                        $result2 = '
                        <th>T???ng ti???n c???n tr???</th>
                        <td><strong><span class="amount">'.Helpers::currencyFormat($total).'</span></strong></td>
                        <input type="hidden" id="hd-total" value="'.$total.'">
                        <input type="hidden" id="hd-coupons" value="'.$couponsExisted[0]->offer.'">
                        ';
                        return response()->json([
                            'pass' => 'Th??nh c??ng!',
                            'coupons' => $result1,
                            'total' => $result2
                        ]);
                    }
                } else {
                    return response()->json([
                        'fail' => 'Kh??ng c?? m?? gi???m gi?? n??y!'
                    ]);
                }
            }
        }
    }
}
