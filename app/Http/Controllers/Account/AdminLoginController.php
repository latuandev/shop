<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    //
    public function index()
    {
        return view('account.admin.login');
    }
    //
    public function handle(Request $request)
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
            $remember = $request->has('remember') ? true : false;
            $auth = [
                'email' => $request->email,
                'password' => $request->password,
                'role' => 1
            ];
            if (Auth::attempt($auth, $remember)) {
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
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/admin/login');
    }
}
