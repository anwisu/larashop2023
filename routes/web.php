<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
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

Route::resource('customer', CustomerController::class);
Route::resource('item', ItemController::class)->middleware('role:admin,customer');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/items', [ItemController::class, 'index']);

Route::get('/', [ItemController::class, 'getItems'])->name('getItems');
Route::get('add-to-cart/{id}', [ItemController::class, 'addToCart'])->name('addToCart');
Route::get('/shopping-cart', [ItemController::class, 'getCart'])->name('shoppingCart');
Route::get('remove/{id}',[ItemController::class, 'removeItem'])->name('item.remove');
Route::get('reduce/{id}',[ItemController::class, 'getReduceByOne'])->name('item.reduceByOne');
Route::get('checkout',[ItemController::class, 'postCheckout'])->name('checkout');
Route::post('item/store-media', [ItemController::class, 'storeMedia'])->name('item.storeMedia')->middleware('role:admin');
Route::post('/search', [SearchController::class,'search'])->name('search');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->group(function () {
    Route::get('/signup', [UserController::class, 'getSignup']);
    Route::post('/signup', [UserController::class, 'postSignup'])->name('user.signup');
    Route::get('profile', [UserController::class, 'getProfile' ])->name('user.profile')->middleware('auth');
    Route::view('/signin', 'user.signin');
    Route::post('/signin', [LoginController::class, 'postSignin'])->name('user.signin');
    Route::get('/logout',[LoginController::class,'getLogout'])->name('user.logout')->middleware('auth');
    Route::get('/order/{id}',[OrderController::class,'orderDetails'])->name('order.orderDetails')->middleware('auth');

});

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/orders',[OrderController::class,'orders'])->name('admin.orders');
        Route::get('/orders/{id}',[OrderController::class,'processOrder'])->name('admin.orderDetails');
        Route::post('/order/{id}', [OrderController::class, 'orderUpdate'])->name('admin.orderUpdate');
        Route::get('/users', [UserController::class, 'getUsers'])->name('admin.users');
        Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

Route::post('/import', [ItemController::class, 'import'])->name('item-import');



