<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        Route::put('order/{order}', [OrderController::class, 'update'])->name('order.update');
        Route::get('order-detail/{order}', [OrderController::class, 'detail'])->name('order.detail');

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

        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::post('/comments/sort-delete/{comment}', [CommentController::class, 'sortDelete'])->name('comments.sortdelete');
        Route::post('/comments/restore/{id}', [CommentController::class, 'restore'])->name('comments.restore');
    });

Route::prefix('admin')->as('admin.')->group(function () {
    
    Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    
});
