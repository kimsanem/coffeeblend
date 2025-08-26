<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

//  FOR === LOGIN === AND === REGISTER ===
Auth::routes();


Route::get('/', function () {
    if(Auth::check()) {  //if logged in go to /
        return redirect()->route('/');
    }else{  // if not (logged out) then go to login
        return redirect()->route('login');
    }
    return view(compact('login'));
});

// ROUTE FOR NAVIGATION
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('menu', [App\Http\Controllers\MenuController::class, 'menu'])->name('menu');
Route::get('services', [App\Http\Controllers\ServicesController::class, 'index'])->name('services');
Route::get('about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');


Route::group(['prefix' => 'products'], function () {
    // products route
    // Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('cart-delete/{id}', [ProductController::class, 'deleteProductCart'])->name('cart.product.delete');
    Route::get('{id}', [ProductController::class, 'singleProduct'])->name('product.single');
    Route::post('{id}', [ProductController::class, 'addToCart'])->name('add.cart');

    //checkout route
    Route::post('prepare-checkout', [ProductController::class, 'prepareCheckout'])->name('prepare.checkout');
    Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [ProductController::class, 'storeCheckout'])->name('process.checkout');

    // payment
    Route::get('pay', [ProductController::class, 'pay'])->name('pay');
    Route::get('success', [ProductController::class, 'success'])->name('success');
});


Route::group(['prefix'=> 'users'], function () {
    // user bookings
    Route::get('orders', [UsersController::class, 'displayOrders'])->name('orders');
    Route::get('bookings', [UsersController::class, 'displayBookings'])->name('bookings');

    // write review
    Route::get('write-review', [UsersController::class, 'writeReview'])->name('write.review');
    Route::post('write-review', [UsersController::class, 'processWriteReview'])->name('process.write.review');
});


Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.auth');
Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');
Route::post('admin/logout', [adminsController::class, 'logout'])->name('admin.logout');


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], routes: function () {
    Route::get('index', [AdminsController::class,'index'])->name('admins.dashboard');

    // admins section
    Route::get('all-admins', [AdminsController::class,'displayAllAdmins'])->name('all.admins');
    Route::get('create-admin', [AdminsController::class, 'createAdmin'])->name('create.admin');
    Route::post('create-admin', [adminsController::class, 'storeAdmin'])->name('store.admin');
    Route::delete('delete-admin/{id}', [adminsController::class, 'deleteAdmin'])->name('delete.admin');


    // orders section
    Route::get('all-orders', [AdminsController::class, 'displayAllOrders'])->name('all.orders');
    Route::get('edit-order/{id}', [AdminsController::class, 'editOrder'])->name('edit.order');
    Route::put('edit-order/{id}', [AdminsController::class, 'updateOrder'])->name('update.order');
    Route::get('delete-order/{id}', [AdminsController::class, 'deleteOrder'])->name('delete.order');

    // products section
    Route::get('all-products', [AdminsController::class, 'displayAllProducts'])->name('all.products');
    Route::get('create-product', [AdminsController::class, 'createProduct'])->name('create.product');
    Route::post('create-product', [AdminsController::class, 'storeProduct'])->name('store.product');
    Route::get('delete-product/{id}', [AdminsController::class, 'deleteProduct'])->name('delete.product');

    // bookings section
    Route::get('all-bookings', [AdminsController::class, 'displayAllBookings'])->name('all.bookings');
    Route::get('delete-booking/{id}', [AdminsController::class, 'deleteBooking'])->name('delete.booking');
    Route::get('edit-booking/{id}', [AdminsController::class, 'editBooking'])->name('edit.booking');
    Route::put('edit-booking/{id}', [AdminsController::class, 'updateBooking'])->name('update.booking');
});
