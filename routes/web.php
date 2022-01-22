<?php

use App\Http\Controllers\Account\AdminLoginController;
use App\Http\Controllers\Account\FacebookLoginController;
use App\Http\Controllers\Account\GoogleLoginController;
use App\Http\Controllers\Account\UserLoginController;
use App\Http\Controllers\Account\UserRegisterController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCouponsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\UserAboutUsController;
use App\Http\Controllers\User\UserBrandController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// session for users
Route::get('/', [UserHomeController::class, 'index'])->name('home');
// session for search
Route::get('/search', [UserSearchController::class, 'index'])->name('search');
Route::get('/search/load-more-data', [UserSearchController::class, 'loadMoreData'])->name('load-more-data.search');
// session for categories
Route::get('/categories/{url}', [UserCategoryController::class, 'index']);
Route::get('/categories/{url}/load-more-data', [UserCategoryController::class, 'loadMoreData']);
// session for brands
Route::get('/brands/{url}', [UserBrandController::class, 'index']);
Route::get('/brands/{url}/load-more-data', [UserBrandController::class, 'loadMoreData']);
// session for products
Route::get('/products/{url}', [UserProductController::class, 'index']);
// session for cart
Route::get('/cart', [UserCartController::class, 'index'])->name('cart');
Route::post('/add-to-cart', [UserCartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-product-from-cart', [UserCartController::class, 'removeProductFromCart'])->name('remove-product-from-cart');
Route::post('/update-cart', [UserCartController::class, 'updateCart'])->name('update-cart');
Route::post('/remove-cart', [UserCartController::class, 'removeCart'])->name('remove-cart');
// login
Route::get('/login', [UserLoginController::class, 'index'])->name('user.login');
Route::post('/login/handle', [UserLoginController::class, 'login'])->name('user.login.handle');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
Route::get('/forgot-password', [UserLoginController::class, 'forgotPassword'])->name('user.forgot-password');
Route::post('/reset-password', [UserLoginController::class,'sendCode'])->name('user.reset-password');
Route::post('/reset-password/handle', [UserLoginController::class, 'resetPassword'])->name('user.reset-password.handle');
// register
Route::get('/register', [UserRegisterController::class, 'index'])->name('user.register');
Route::post('/register/handle', [UserRegisterController::class, 'register'])->name('user.register.handle');
Route::post('/register/verified', [UserRegisterController::class, 'verified'])->name('user.register.verified');
Route::post('/register/resend-code', [UserRegisterController::class, 'resendCode'])->name('user.resend-code');
// login with socialite
Route::get('/auth/facebook/redirect', [FacebookLoginController::class, 'handleFacebookRedirect'])->name('login-with-facebook');
Route::get('/auth/facebook/callback', [FacebookLoginController::class, 'handleFacebookCallback']);
Route::get('/auth/google/redirect', [GoogleLoginController::class, 'handleGoogleRedirect'])->name('login-with-google');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
// session for checkout & users
Route::middleware(['auth.user'])->group(function () {
    Route::get('/check-out', [UserCartController::class, 'checkoutView'])->name('check-out');
    Route::post('/check-out/coupons-applied', [UserCartController::class, 'couponsApplied'])->name('check-out.coupons');
    Route::post('/check-out/confirm', [UserCartController::class, 'checkoutConfirm'])->name('check-out.confirm');
    // session for user accounts
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/changed-info', [UserController::class, 'changedInfo'])->name('users.changed-info');
    Route::post('/users/order-details', [UserController::class, 'orderDetails'])->name('users.order-details');
    Route::post('/users/verified-email', [UserController::class, 'verifiedEmail'])->name('users.verified-email');
});
// session for about
Route::get('/about-us', [UserAboutUsController::class, 'index'])->name('about-us');
// session for admin accounts
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login/handle', [AdminLoginController::class, 'handle'])->name('admin.handle.login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
// session for admin
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // sliders
    Route::get('/admin/sliders', [AdminSliderController::class, 'index'])->name('admin.sliders');
    Route::post('/admin/sliders/add', [AdminSliderController::class, 'add'])->name('admin.add.sliders');
    Route::post('/admin/sliders/delete', [AdminSliderController::class, 'delete'])->name('admin.delete.sliders');
    // brands
    Route::get('/admin/brands', [AdminBrandController::class, 'index'])->name('admin.brands');
    Route::post('/admin/brands/add', [AdminBrandController::class, 'add'])->name('admin.add.brands');
    Route::post('/admin/brands/change-status', [AdminBrandController::class, 'changeStatus'])->name('admin.change-status.brands');
    Route::post('/admin/brands/delete', [AdminBrandController::class, 'delete'])->name('admin.delete.brands');
    // categories
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories/add', [AdminCategoryController::class, 'add'])->name('admin.add.categories');
    Route::post('/admin/categories/change-status', [AdminCategoryController::class, 'changeStatus'])->name('admin.change-status.categories');
    Route::post('/admin/categories/delete', [AdminCategoryController::class, 'delete'])->name('admin.delete.categories');
    // products
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/add-view', [AdminProductController::class, 'addView'])->name('admin.add-view.products');
    Route::post('/admin/products/add', [AdminProductController::class, 'add'])->name('admin.add.products');
    Route::post('/admin/products/change-status', [AdminProductController::class, 'changeStatus'])->name('admin.change-status.products');
    Route::post('/admin/products/delete', [AdminProductController::class, 'delete'])->name('admin.delete.products');
    Route::get('/admin/products/{url}', [AdminProductController::class, 'productDetails']);
    Route::post('/admin/products/edit', [AdminProductController::class, 'edit'])->name('admin.edit.products');
    Route::post('/admin/products/delete-galleries', [AdminProductController::class, 'deleteGalleries'])->name('admin.delete-galleries.products');
    Route::get('/admin/products/statistical', [AdminProductController::class, 'statisticalView'])->name('admin.products.statistical');
    // orders
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{code}', [AdminOrderController::class, 'orderDetails']);
    Route::post('/admin/orders/confirm', [AdminOrderController::class, 'confirmOrder'])->name('admin.confirm-order');
    Route::post('/admin/orders/delivered', [AdminOrderController::class, 'delivered'])->name('admin.delivered');
    Route::post('/admin/orders/cancel', [AdminOrderController::class, 'cancelOrder'])->name('admin.cancel-order');
    Route::get('/admin/orders-shipping', [AdminOrderController::class, 'shippingView'])->name('admin.orders.ship');
    Route::get('/admin/orders-statistical', [AdminOrderController::class, 'statisticalView'])->name('admin.orders.statistical');
    // coupons
    Route::get('/admin/coupons', [AdminCouponsController::class, 'index'])->name('admin.coupons');
    Route::post('/admin/coupons/add', [AdminCouponsController::class, 'add'])->name('admin.add.coupons');
    Route::post('/admin/coupons/delete', [AdminCouponsController::class, 'delete'])->name('admin.delete.coupons');
    // users
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
});
