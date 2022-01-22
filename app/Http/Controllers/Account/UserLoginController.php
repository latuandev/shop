<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Jobs\ResendEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserLoginController extends Controller
{
    //
    public function index()
    {
        return view('account.user-login');
    }
    //
    public function login(Request $request)
    {
        $vali = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Vui lòng nhập đúng định dạng email!',
            'password.required' => 'Vui lòng nhập mật khẩu!'
        ]);
        if ($vali->fails()) {
            return response()->json([
                'fail' => $vali->errors()->first()
            ]);
        } else {
            //
            $remember = $request->has('remember') ? true : false;
            $auth = [
                'email' => $request->email,
                'password' => $request->password,
                'role' => 2
            ];
            $admin = [
                'email' => $request->email,
                'password' => $request->password,
                'role' => 1
            ];
            if (Auth::attempt($auth, $remember) || Auth::attempt($admin, $remember)) {
                return response()->json([
                    'pass' => 'Đăng nhập thành công!'
                ]);
            } else {
                return response()->json([
                    'fail' => 'Thông tin đăng nhập không đúng!'
                ]);
            }
        }
    }
    //
    public function forgotPassword(Request $request)
    {
        return view('account.user-forgot-password');
    }
    //
    public function sendCode(Request $request)
    {
        if($request->ajax()) {
            $existedEmail = User::where('email', $request->email)
            ->select('name')->get();
            $code = Str::random(6);
            if(!$existedEmail->isEmpty()) {
                $data = array(
                    'email' => $request->email,
                    'name' => $existedEmail[0]->name,
                    'code' => $code
                );
                dispatch(new ResendEmail($data));
                User::where('email', $request->email)->update(['code' => $code]);
                return response()->json([
                    'pass' => 'Chúng tôi đã gửi mã xác nhận đến email của bạn!',
                    'reset' => '
                    <form id="f-reset-password" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                            <div class="login-form">
                                <h4 class="login-title">Đặt lại mật khẩu</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Mã xác nhận</label>
                                        <input type="text" name="code" id="code" placeholder="Nhập mã xác nhận gửi đến email của bạn">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" name="password" id="password" placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Xác nhận mật khẩu mới</label>
                                        <input type="password" name="confirm_password" id="confirm-password" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-lg-12">
                                            <button type="button" id="btn-reset-password" class="btn btn-custom-size lg-size btn-pronia-primary">Xác nhận</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="btn-resend-email" class="btn btn-custom-size lg-size btn-pronia-primary">Gửi lại mã</button>
                                    </div>
                                    <input type="hidden" id="hd-email" value="'.$request->email.'">
                                    <input type="hidden" id="hd-name" value="'.$existedEmail[0]->name.'">
                                </div>
                            </div>
                        </form>
                    '
                ]);
            } else {
                return response()->json([
                    'fail' => 'Email này chưa đăng ký tài khoản!'
                ]);
            }
        }
    }
    //
    public function resetPassword(Request $request)
    {
        if($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'code' => 'required',
                'password' => 'required',
                'confirm_password' => 'required | same:password'
            ], [
                'code.required' => 'Vui lòng nhập mã xác nhận!',
                'password.required' => 'Vui lòng nhập mật khẩu!',
                'confirm_password.same' => 'Mật khẩu không trùng!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $time = date('Y-m-d H:i:s');
                $checkCode = User::where([['email', $request->email], ['code', $request->code]])
                ->first();
                if($checkCode) {
                    User::where('email', $request->email)->update([
                        'email_verified_at' => $time,
                        'password' => bcrypt($request->password),
                        'unencrypted_password' => $request->password
                    ]);
                    return response()->json([
                        'pass' => 'Đặt lại mật khẩu thành công!'
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
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }
}
