<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductServiceController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductServiceCategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource(
            'product-categories',
            ProductServiceCategoryController::class
        );
        Route::resource('products', ProductServiceController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('timelines', TimelineController::class);
        Route::resource(
            'product-service-categories',
            ProductServiceCategoryController::class
        );
        Route::resource('product-images', ProductImageController::class);
        Route::get('all-orders', [OrdersController::class, 'index'])->name(
            'all-orders.index'
        );
        Route::post('all-orders', [OrdersController::class, 'store'])->name(
            'all-orders.store'
        );
        Route::get('all-orders/create', [
            OrdersController::class,
            'create',
        ])->name('all-orders.create');
        Route::get('all-orders/{orders}', [
            OrdersController::class,
            'show',
        ])->name('all-orders.show');
        Route::get('all-orders/{orders}/edit', [
            OrdersController::class,
            'edit',
        ])->name('all-orders.edit');
        Route::put('all-orders/{orders}', [
            OrdersController::class,
            'update',
        ])->name('all-orders.update');
        Route::delete('all-orders/{orders}', [
            OrdersController::class,
            'destroy',
        ])->name('all-orders.destroy');

        Route::resource('category-products', CategoryProductController::class);
        Route::resource('product-services', ProductServiceController::class);
    });
