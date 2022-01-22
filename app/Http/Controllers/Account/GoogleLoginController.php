<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    const DRIVER_TYPE = 'google';
    //
    public function handleGoogleRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }
    //
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver(static::DRIVER_TYPE)->user();
            // check user login with socialite
            $existedUser = User::where('oauth_id', $user->id)
            ->where('oauth_type', static::DRIVER_TYPE)->first();
            $remember = true;
            $time = date('Y-m-d H:i:s');
            if ($existedUser) {
                Auth::login($existedUser, $remember);
                return Redirect::to('/cart');
            } else {
                // check user registed with email
                $registedUser = User::where('email', $user->email)
                ->first();
                if($registedUser) {
                    return Redirect::to('/login')->withErrors(['msg' => 'Email '.$user->email.' đã đăng ký tài khoản. Vui lòng đăng nhập bằng mật khẩu!']);
                } else {
                    $newUser = new User();
                    $newUser->name = $user->name;
                    $newUser->email = $user->email;
                    $newUser->email_verified_at = $time;
                    $newUser->oauth_id = $user->id;
                    $newUser->oauth_type = static::DRIVER_TYPE;
                    $newUser->password = bcrypt($user->id);
                    $newUser->unencrypted_password = $user->id;
                    $newUser->role = 2;
                    $newUser->status = 1;
                    $newUser->save();
                    Auth::login($newUser, $remember);
                    return Redirect::to('/cart');
                }
            }
        } catch (Exception $e) {
            return Redirect::to('/');
        }
    }
}
