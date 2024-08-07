<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\Auth\LoginController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MyAccountController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ProductController::class, 'productList'])->name('shop');

Route::get('/shop/{id}/{slug}', [ProductController::class, 'productCatalogue'])->name('shop.slug');

Route::get('/product/{slug}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::get('/cart', [CartController::class, 'list'])->name('cart.list');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [OrderController::class, 'view'])->name('checkout.view');

Route::post('/add/coupon', [OrderController::class, 'addCoupon'])->name('add.coupon');

Route::get('/delete/coupon', [OrderController::class, 'deleteCoupon'])->name('delete.coupon');

Route::post('/checkout', [OrderController::class, 'create'])->name('checkout.create');

Route::get('/payment/momo', [PaymentController::class, 'momoPayment'])->name('payment.momo');

Route::get('/handle/momo', [PaymentController::class, 'handleOrder'])->name('handle.momo');





Route::get('/login', [LoginController::class, 'showFormLogin'])->name('form.login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('form.register');

Route::post('/register', [RegisterController::class, 'save'])->name('register');

Route::get('/verify/{token}', [LoginController::class, 'verify'])->name('verify');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['checkLogin'])->group(function () {
    
    Route::get('/my-account', [MyAccountController::class, 'index'])->name('my.account');

    Route::get('/order/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');

    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');

    Route::post('/comment', [CommentController::class, 'save'])->name('comment.save');
    
});














// Auth::routes();
/**
 * composer require laravel/ui
 * php artisan ui bootstrap -auth
 * npm rundev
 */

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
// Route::post('auth/login', [LoginController::class, 'login']);
// Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
// Route::post('auth/register', [RegisterController::class, 'register']);





