<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/akcija', [HomeController::class, 'akcija']);
Route::get('/novo', [HomeController::class, 'novo']);
Route::get('/trend', [HomeController::class, 'trend']);
Route::get('/product/{slug}', [HomeController::class, 'show'])->name('product');

Route::get('cart', [HomeController::class, 'cart']);
Route::resource('cart', CartController::class);
Route::resource('order', OrderController::class);
Route::get('order/confirm/{id}', [OrderController::class, 'confirm'])
    ->name('order.confirm');
Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart']);
Route::patch('update-cart', [CartController::class, 'update']);

Route::delete('remove-from-cart', [CartController::class, 'remove']);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::group(
    ['prefix' => 'admin', 'middleware' => 'auth'],
    function () {
        Route::get('/products/delete', [ProductController::class, 'delete'])->name('products.delete');
        Route::resource('products', ProductController::class);
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('attribute', AttributeController::class);
        Route::resource('option', OptionController::class);
        Route::resource('category', CategoryController::class);
//        Route::resource('products', ProductController::class);
        Route::post('imageupload', [ProductController::class, 'upload'])->name('imageupload');
        Route::resource('block', BlockController::class);
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrderController::class, 'showOrder'])->name('orders.show');
        Route::get('/settings', [SettingsController::class,'index'])->name('settings');
        Route::post('/settings', [SettingsController::class,'store'])->name('settings.store');
    }
);
Route::get('/clear-cache', function () {
    $clearcache = Artisan::call('cache:clear');
    $clearconfig = Artisan::call('config:clear');
});
