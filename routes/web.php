<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
    if(Auth::check()) {
        return redirect()->route('home');
    }else{
        return redirect()->route('login');
    }
    return view(compact('login'));
});


// ROUTE FOR NAVIGATION
Route::get('/home', [HomeController::class, 'index'])->name('home');

// products route
// Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'singleProduct'])->name('product.single');
Route::post('/products/{id}', [ProductController::class, 'addToCart'])->name('add.cart');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::get('/cart-delete/{id}', [ProductController::class, 'deleteProductCart'])->name('cart.product.delete');

//checkout route
Route::post('/prepare-checkout', [ProductController::class, 'prepareCheckout'])->name('prepare.checkout');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');


//navigation route
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index'])->name('services');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
