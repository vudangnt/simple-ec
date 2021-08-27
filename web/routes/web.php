<?php

use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\UserController;
use App\Models\Products;
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
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'backend.', 'namespace' => 'Backend'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::resources([
        'products' => 'ProductsController',
        'brands' => 'BrandsController',
        'images' => 'ImagesController'
    ]);
});
Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('login', [UserController::class, 'index'])->name('login.index');
Route::post('login', [UserController::class, 'login'])->name('login.login');

Route::group(['as' => 'frontend.'], function() {
    Route::get('/', [ProductsController::class, 'lists'])->name('home');
    Route::get('brand/{slug}', [ProductsController::class, 'lists'])->name('brand');
    Route::get('{slug}', [ProductsController::class, 'show'])->name('product.detail');
});
