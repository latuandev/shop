<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Jobs\ResendEmail;
use App\Jobs\SendMailVerified;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserRegisterController extends Controller
{
    //
    public function index() {
        return view('account.user-register');
    }
    //
    public function register(Request $request)
    {
        if($request->ajax()) {
            $vali = Validator::make($request->all(), [
                'name' => 'required | max:255',
                'email' => 'required | email',
                'password' => 'required',
                'confirm_password' => 'required | same:password'
            ], [
                'name.required' => 'Vui lòng nhập tên của bạn!',
                'name.max' => 'Tên quá dài!',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'vui lòng nhập đúng định dạng email!',
                'password.required' => 'Vui lòng nhập mật khẩu!',
                'confirm_password.required' => 'Vui lòng xác nhận mật khẩu!',
                'confirm_password.same' => 'Mật khẩu không trùng!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $existedEmail = User::where('email', $request->email)->first();
                if($existedEmail) {
                    return response()->json([
                        'fail' => 'Email đã được sử dụng!'
                    ]);
                } else {
                    $code = Str::random(6);
                    $create = new User();
                    $create->name = $request->name;
                    $create->email = $request->email;
                    $create->password = bcrypt($request->password);
                    $create->unencrypted_password = $request->password;
                    $create->role = 2;
                    $create->status = 1;
                    $create->code = $code;
                    $create->save();
                    $data = array(
                        'title' => 'Xác nhận tài khoản của bạn!',
                        'code' => $code,
                        'email' => $request->email,
                        'password' => $request->password,
                        'name' => $request->name
                    );
                    dispatch(new SendMailVerified($data));
                    return response()->json([
                        'pass' => 'Thành công!<br>Chúng tôi đã gửi một xác nhận đến email của bạn!',
                        'verified' => '
                        <form id="f-verified" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                            <div class="login-form">
                                <h4 class="login-title">Xác nhận email</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Mã xác nhận</label>
                                        <input type="text" name="code" id="code" placeholder="Nhập mã xác nhận được gửi đến email của bạn">
                                        </div>
                                    <div class="col-md-4">
                                        <div class="col-lg-12">
                                            <button type="button" id="btn-verified" class="btn btn-custom-size lg-size btn-pronia-primary">Xác nhận</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="btn-resend-email" class="btn btn-custom-size lg-size btn-pronia-primary">Gửi lại mã</button>
                                    </div>
                                    <input type="hidden" name="hdEmail" id="hd-email" value="'.$request->email.'">
                                    <input type="hidden" name="hdName" id="hd-name" value="'.$request->name.'">
                                </div>
                            </div>
                        </form>
                        '
                    ]);
                }
            }
        }
    }
    //
    public function verified(Request $request)
    {
        if($request->ajax()) {
            $time = date('Y-m-d H:i:s');
            $vali = Validator::make($request->all(), [
                'code' => 'required'
            ], [
                'code.required' => 'Vui lòng nhập mã xác nhận!'
            ]);
            if($vali->fails()) {
                return response()->json([
                    'fail' => $vali->errors()->first()
                ]);
            } else {
                $existedCode = User::where('email', $request->hdEmail)
                ->select('code', 'unencrypted_password')->get();
                foreach ($existedCode as $key => $value) {
                    if($value->code == $request->code) {
                        User::where('email', $request->email)
                        ->update(['email_verified_at' => $time, 'code' => '']);
                        return response()->json([
                            'pass' => 'Thành công!',
                            'email' => $request->email,
                            'password' => $value->unencrypted_password
                        ]);
                    } else {
                        return response()->json([
                            'fail' => 'Mã xác nhận không đúng!'
                        ]);
                    }
                }
            }
        }
    }
    //
    public function resendCode(Request $request)
    {
        if($request->ajax()) {
            $data = array(
                'email' => $request->email,
                'name' => $request->name,
                'code' => Str::random(6)
            );
            User::where('email', $data['email'])->update(['code' => $data['code']]);
            dispatch(new ResendEmail($data));
            return response()->json('Chúng tôi đã gửi mã xác nhận đến email của bạn!');
        }
    }
}
