<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TimelineController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserServicesController;
use App\Http\Controllers\Api\ProductImageController;
use App\Http\Controllers\Api\UserAllOrdersController;
use App\Http\Controllers\Api\ProductServiceController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ServiceTimelinesController;
use App\Http\Controllers\Api\UserProductServicesController;
use App\Http\Controllers\Api\OrdersAllOrderitemsController;
use App\Http\Controllers\Api\ProductServiceCategoryController;
use App\Http\Controllers\Api\ProductServiceServicesController;
use App\Http\Controllers\Api\CategoryProductProductsController;
use App\Http\Controllers\Api\ProductServiceCategoryProductServicesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Products
        Route::get('/users/{user}/product-services', [
            UserProductServicesController::class,
            'index',
        ])->name('users.product-services.index');
        Route::post('/users/{user}/product-services', [
            UserProductServicesController::class,
            'store',
        ])->name('users.product-services.store');

        // User Services
        Route::get('/users/{user}/services', [
            UserServicesController::class,
            'index',
        ])->name('users.services.index');
        Route::post('/users/{user}/services', [
            UserServicesController::class,
            'store',
        ])->name('users.services.store');

        // User All Orders
        Route::get('/users/{user}/all-orders', [
            UserAllOrdersController::class,
            'index',
        ])->name('users.all-orders.index');
        Route::post('/users/{user}/all-orders', [
            UserAllOrdersController::class,
            'store',
        ])->name('users.all-orders.store');

        Route::apiResource(
            'product-categories',
            ProductServiceCategoryController::class
        );

        // ProductServiceCategory Products
        Route::get(
            '/product-service-categories/{productServiceCategory}/product-services',
            [ProductServiceCategoryProductServicesController::class, 'index']
        )->name('product-service-categories.product-services.index');
        Route::post(
            '/product-service-categories/{productServiceCategory}/product-services',
            [ProductServiceCategoryProductServicesController::class, 'store']
        )->name('product-service-categories.product-services.store');

        Route::apiResource('products', ProductServiceController::class);

        // ProductService Services
        Route::get('/product-services/{productService}/services', [
            ProductServiceServicesController::class,
            'index',
        ])->name('product-services.services.index');
        Route::post('/product-services/{productService}/services', [
            ProductServiceServicesController::class,
            'store',
        ])->name('product-services.services.store');

        Route::apiResource('services', ServiceController::class);

        // Service Timelines
        Route::get('/services/{service}/timelines', [
            ServiceTimelinesController::class,
            'index',
        ])->name('services.timelines.index');
        Route::post('/services/{service}/timelines', [
            ServiceTimelinesController::class,
            'store',
        ])->name('services.timelines.store');

        Route::apiResource('timelines', TimelineController::class);

        Route::apiResource(
            'product-service-categories',
            ProductServiceCategoryController::class
        );

        // ProductServiceCategory Products
        Route::get(
            '/product-service-categories/{productServiceCategory}/product-services',
            [ProductServiceCategoryProductServicesController::class, 'index']
        )->name('product-service-categories.product-services.index');
        Route::post(
            '/product-service-categories/{productServiceCategory}/product-services',
            [ProductServiceCategoryProductServicesController::class, 'store']
        )->name('product-service-categories.product-services.store');

        Route::apiResource('product-images', ProductImageController::class);

        Route::apiResource('all-orders', OrdersController::class);

        // Orders All Orderitems
        Route::get('/all-orders/{orders}/all-orderitems', [
            OrdersAllOrderitemsController::class,
            'index',
        ])->name('all-orders.all-orderitems.index');
        Route::post('/all-orders/{orders}/all-orderitems', [
            OrdersAllOrderitemsController::class,
            'store',
        ])->name('all-orders.all-orderitems.store');

        Route::apiResource(
            'category-products',
            CategoryProductController::class
        );

        // CategoryProduct Products
        Route::get('/category-products/{categoryProduct}/products', [
            CategoryProductProductsController::class,
            'index',
        ])->name('category-products.products.index');
        Route::post('/category-products/{categoryProduct}/products', [
            CategoryProductProductsController::class,
            'store',
        ])->name('category-products.products.store');

        Route::apiResource('product-services', ProductServiceController::class);

        // ProductService Services
        Route::get('/product-services/{productService}/services', [
            ProductServiceServicesController::class,
            'index',
        ])->name('product-services.services.index');
        Route::post('/product-services/{productService}/services', [
            ProductServiceServicesController::class,
            'store',
        ])->name('product-services.services.store');
    });
