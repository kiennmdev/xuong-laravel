<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Client\Auth\LoginController;
use App\Http\Controllers\Client\Auth\RegisterController;
use App\Http\Controllers\Client\MyAccountController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckLoginMiddleware;


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

Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/shop', [ProductController::class, 'productList'])->name('shop');
Route::get('/shop/{id}/{slug}', [ProductController::class, 'productCatalogue'])->name('shop.slug');
Route::get('/product/{slug}', [ProductController::class, 'productDetail'])->name('product.detail');
Route::get('/cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/checkout', [OrderController::class, 'view'])->name('checkout.view');
Route::post('/checkout', [OrderController::class, 'create'])->name('checkout.create');





Route::get('/login-register', [LoginController::class, 'showFormLoginAndRegister'])->name('show.form.login.register');
Route::post('/register', [RegisterController::class, 'save'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/my-account', [MyAccountController::class, 'index'])->name('my.account')->middleware(CheckLoginMiddleware::class);
Route::post('/comment', [CommentController::class, 'save'])->name('comment.save')->middleware(CheckLoginMiddleware::class);














// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
// Route::post('auth/login', [LoginController::class, 'login']);
// Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
// Route::post('auth/register', [RegisterController::class, 'register']);





