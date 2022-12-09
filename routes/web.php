<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryPagesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePageController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/men', [WelcomePageController::class, 'men'])->name('menWelcomePage');
Route::get('/', function() {
    return redirect(route('menWelcomePage'));
})->name('welcomePage');

Route::get('/men/{slug_category}/{slug_subcategory}', [CategoryPagesController::class, 'getProductsByCategory'])->name('getProductsByCategory');
Route::get('/men/{slug_category}/{slug_subcategory}/{slug_post}', [ProductPageController::class, 'getProduct'])->name('getProduct');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin-panel')->group(function() {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');

    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('subcategory', App\Http\Controllers\Admin\SubcategoryController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('productImage', App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrderController::class);
});
// Route::middleware(['role:admin'])->prefix('admin-panel')->group(function () {
// });

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('auth.google');
Route::get('auth/google/callback', [SocialController::class, 'loginWithGoogle']);

Route::get('/checkout-email/to/{email}/{order_id}', [EmailController::class, "checkoutEmail"])->name('email.checkout');
Route::get('/register-email/to/{email}', [EmailController::class, "registerEmail"])->name('email.register');
