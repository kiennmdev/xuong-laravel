<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('order')->as('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::put('{order}', [OrderController::class, 'update'])->name('update');
            Route::get('detail/{order}', [OrderController::class, 'detail'])->name('detail');
        });

        Route::prefix('catalogues')
            ->as('catalogues.')
            ->group(function () {
                Route::get('/',                [CatalogueController::class, 'index'])->name('index');
                Route::get('create',           [CatalogueController::class, 'create'])->name('create');
                Route::post('store',           [CatalogueController::class, 'store'])->name('store');
                Route::get('show/{id}',        [CatalogueController::class, 'show'])->name('show');
                Route::get('{id}/edit',        [CatalogueController::class, 'edit'])->name('edit');
                Route::put('{id}/update',      [CatalogueController::class, 'update'])->name('update');
                Route::get('{id}/destroy',     [CatalogueController::class, 'destroy'])->name('destroy');
            });

        Route::resource('products', ProductController::class);

        Route::resource('users', UserController::class);

        Route::resource('banners', BannerController::class);

        Route::resource('coupon', CouponController::class);

        Route::prefix('comment')->as('comments.')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
            Route::post('sort-delete/{comment}', [CommentController::class, 'sortDelete'])->name('sortdelete');
            Route::post('restore/{id}', [CommentController::class, 'restore'])->name('restore');
        });
    });

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
