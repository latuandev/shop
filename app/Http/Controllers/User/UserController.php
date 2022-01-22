<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\ResendEmail;
use App\Order;
use App\OrderDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $orders = Order::latest()->where('user_id', Auth::id())
            ->select('id', 'code', 'product_total', 'total', 'status', 'updated_at')->paginate(10);
        return view('user.account.users', compact('orders'));
    }
    //
    public function changedInfo(Request $request)
    {
        if ($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required | email'
            ], [
                'name.required' => 'Vui lòng nhập tên của bạn!',
                'phone.required' => 'Vui lòng nhập số điện thoại của bạn!',
                'email.required' => 'Vui lòng nhập email của bạn!',
                'email.email' => 'Vui lòng nhập đúng định dạng email!'
            ]);
            if ($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                // if the email has not changed
                $email = User::where([['id', Auth::id()], ['email', $request->email]])
                    ->first();
                if ($email) {
                    // if the password has not changed
                    if (empty($request->current_password) && empty($request->new_password) && empty($request->confirm_new_password)) {
                        User::where('id', Auth::id())->update([
                            'name' => $request->name,
                            'phone' => $request->phone
                        ]);
                        return response()->json([
                            'pass' => 'Thành công!'
                        ]);
                    } else if (empty($request->current_password) || empty($request->new_password) || empty($request->confirm_new_password)) {
                        return response()->json([
                            'fail' => 'Vui lòng nhập đủ các trường mật khẩu nếu muốn đặt mật khẩu mới!'
                        ]);
                    } else if (!empty($request->current_password) && !empty($request->new_password) && !empty($request->confirm_new_password)) {
                        // if the password has been changed and has been successfully confirmed
                        $oldPassword = User::where([['id', Auth::id()], ['unencrypted_password', $request->current_password]])->first();
                        if (!$oldPassword) {
                            return response()->json([
                                'fail' => 'Mật khẩu cũ không đúng!'
                            ]);
                        } else if ($request->new_password == $request->confirm_new_password) {
                            User::where('id', Auth::id())->update([
                                'name' => $request->name,
                                'password' => bcrypt($request->new_password),
                                'unencrypted_password' => $request->new_password,
                                'phone' => $request->phone
                            ]);
                            return response()->json([
                                'pass' => 'Thành công!'
                            ]);
                        } else {
                            return response()->json([
                                'fail' => 'Mật khẩu mới không khớp!'
                            ]);
                        }
                    }
                } else {
                    // if the email has changed (new email)
                    $code = Str::random(6);
                    $data = array(
                        'name' => $request->name,
                        'email' => $request->email,
                        'code' => $code
                    );
                    if (empty($request->current_password) && empty($request->new_password) && empty($request->confirm_new_password)) {
                        $emailExisted = User::where('email', $request->email)->first();
                        if ($emailExisted) {
                            return response()->json([
                                'fail' => 'Email đã được sử dụng!'
                            ]);
                        } else {
                            User::where('id', Auth::id())->update([
                                'name' => $data['name'],
                                'email' => $data['email'],
                                'email_verified_at' => null,
                                'phone' => $request->phone,
                                'code' => $code
                            ]);
                            dispatch(new ResendEmail($data));
                            $email = "'" . $request->email . "'";
                            return response()->json([
                                'success' => 'Chúng tôi đã gửi một mã xác nhận đến email của bạn!',
                                'verified' => '
                            <div class="myaccount-details">
                                <form id="f-verified" action="javascript:void(0);" class="myaccount-form">
                                    <div class="myaccount-form-inner">
                                        <div class="single-input single-input-half">
                                            <label>Mã xác nhận email</label>
                                            <input type="text" name="code">
                                        </div>
                                        <div class="single-input">
                                            <button id="btn-verified" class="btn btn-custom-size lg-size btn-pronia-primary"
                                                type="button">
                                                <span>Xác nhận</span>
                                            </button>
                                            <a href="javascript:void(0);" onclick="resendCodeFunction(' . $email . ')">Gửi lại mã</a>
                                            <input type="hidden" id="hd-name" value="' . Auth::user()->name . '">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            '
                            ]);
                        }
                    } else if (empty($request->current_password) || empty($request->new_password) || empty($request->confirm_new_password)) {
                        return response()->json([
                            'fail' => 'Vui lòng nhập đủ các trường mật khẩu nếu muốn đặt mật khẩu mới!'
                        ]);
                    } else if (!empty($request->current_password) && !empty($request->new_password) && !empty($request->confirm_new_password)) {
                        $emailExisted = User::where('email', $request->email)->first();
                        if ($emailExisted) {
                            return response()->json([
                                'fail' => 'Email đã được sử dụng!'
                            ]);
                        } else {
                            // if the password has been changed and has been successfully confirmed
                            $oldPassword = User::where([['id', Auth::id()], ['unencrypted_password', $request->current_password]])->first();
                            if (!$oldPassword) {
                                return response()->json([
                                    'fail' => 'Mật khẩu cũ không đúng!'
                                ]);
                            } else if ($request->new_password == $request->confirm_new_password) {
                                User::where('id', Auth::id())->update([
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'email_verified_at' => null,
                                    'password' => bcrypt($request->new_password),
                                    'unencrypted_password' => $request->new_password,
                                    'phone' => $request->phone,
                                    'code' => $code
                                ]);
                                dispatch(new ResendEmail($data));
                                $email = "'" . $request->email . "'";
                                return response()->json([
                                    'success' => 'Chúng tôi đã gửi một mã xác nhận đến email của bạn!',
                                    'verified' => '
                                    <div class="myaccount-details">
                                        <form id="f-verified" action="javascript:void(0);" class="myaccount-form">
                                            <div class="myaccount-form-inner">
                                                <div class="single-input single-input-half">
                                                    <label>Mã xác nhận email</label>
                                                    <input type="text" name="code">
                                                </div>
                                                <div class="single-input">
                                                    <button id="btn-verified" class="btn btn-custom-size lg-size btn-pronia-primary"
                                                        type="button">
                                                        <span>Xác nhận</span>
                                                    </button>
                                                    <a href="javascript:void(0);" onclick="resendCodeFunction(' . $email . ')">Gửi lại mã</a>
                                                    <input type="hidden" id="hd-name" value="' . Auth::user()->name . '">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    '
                                ]);
                            } else {
                                return response()->json([
                                    'fail' => 'Mật khẩu mới không khớp!'
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
    //
    public function verifiedEmail(Request $request)
    {
        if ($request->ajax()) {
            if (empty($request->code)) {
                return response()->json([
                    'fail' => 'Vui lòng nhập mã xác nhận!'
                ]);
            } else {
                $code = User::where([['id', Auth::id()], ['code', $request->code]])->first();
                $time = date('Y-m-d H:i:s');
                if ($code) {
                    User::where('id', Auth::id())->update(['email_verified_at' => $time, 'code' => '']);
                    return response()->json([
                        'pass' => 'Thành công!'
                    ]);
                } else {
                    return response()->json([
                        'fail' => 'Mã xác nhận không đúng!'
                    ]);
                }
            }
        }
    }
    //
    public function orderDetails(Request $request)
    {
        if ($request->ajax()) {
            $orderDetails = Order::join('order_details', 'orders.code', '=', 'order_details.order_code')
            ->where('order_details.order_code', $request->code)
            ->select(
                'order_details.product_url as url',
                'order_details.product_avatar as avatar',
                'order_details.product_name as name',
                'order_details.product_price as price',
                'order_details.product_qty as qty',
                'order_details.updated_at as time',
                'orders.total as total',
                'orders.status as status'
            )->get();
            $html = '
            <div class="your-order">
                <div class="your-order-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cart-product-name">Sản phẩm</th>
                                <th class="cart-product-total">Giá tiền</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            $productTotal = 0;
            foreach ($orderDetails as $key => $value) {
                $url = url('/products').'/'.$value->url;
                $productTotal += $value->qty*$value->price;
                $html .= '
                <tr class="cart_item">
                    <td class="cart-product-name"> <a href="'.$url.'">'.$value->name.'</a><strong
                    class="product-quantity">
                    × '.$value->qty.'</strong></td>
                    <td class="cart-product-total"><span class="amount">'.Helpers::currencyFormat($value->price).'</span></td>
                </tr>
                ';
            }
            $html .= '
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Tổng tiền sản phẩm</th>
                                <td><span class="amount">'.Helpers::currencyFormat($productTotal).'</span></td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Tổng tiền cần thanh toán</th>
                                <td><span class="amount">'.Helpers::currencyFormat($orderDetails[0]->total).'</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            ';
            if($orderDetails[0]->status == 1) {
                $html .= '
                    <div class="payment-method">
                        <b>Trạng thái: </b><span>Đang chờ xác nhận</span>
                    </div>
                </div>
                ';
            } else if($orderDetails[0]->status == 2) {
                $html .= '
                    <div class="payment-method">
                        <b>Trạng thái: </b><span>Đang vận chuyển</span>
                    </div>
                </div>
            ';
            } else if($orderDetails[0]->status == 3) {
                $html .= '
                    <div class="payment-method">
                        <b>Trạng thái: </b><span>Đã giao hàng</span>
                    </div>
                </div>
            ';
            } else if($orderDetails[0]->status == 4) {
                $html .= '
                    <div class="payment-method">
                        <b>Trạng thái: </b><span>Đã hủy</span>
                    </div>
                </div>
                ';
            }
            return response()->json($html);
        }
    }
}
