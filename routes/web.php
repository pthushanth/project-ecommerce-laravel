<?php

use App\Http\Controllers\ClientController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });


/***************************************  FRONT  **************************************** */
Route::get('/', [FrontController::class, 'index'])->name('index');











/***************************************************************************************** */

Route::get('/logedin', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::user()->role === 'client') {
        return redirect()->route('client.dashboard');
    }
})->middleware(['auth']);

// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //Product
    Route::get('/produit', [ProductController::class, 'index'])->name('products.index');
    Route::get('/ajouter-produit', [ProductController::class, 'create'])->name('products.create');
    Route::post('/ajouter-produit', [ProductController::class, 'store'])->name('products.store');
    Route::get('/modifier-produit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/modifier-produit', [ProductController::class, 'update'])->name('products.update');
    Route::get('/supprimer-produit/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/activer-produit/{id}', [ProductController::class, 'activateProduct'])->name('products.activate');
    Route::get('/desactiver-produit/{id}', [ProductController::class, 'desactivateProduct'])->name('products.desactivate');

    //Attribute
    Route::get('/attribut', [ProductAttributeController::class, 'index'])->name('attributes.index');
    Route::get('/ajouter-attribut', [ProductAttributeController::class, 'create'])->name('attributes.create');
    Route::post('/ajouter-attribut', [ProductAttributeController::class, 'store'])->name('attributes.store');
    Route::get('/modifier-attribut/{id}', [ProductAttributeController::class, 'edit'])->name('attributes.edit');
    Route::post('/modifier-attribut', [ProductAttributeController::class, 'update'])->name('attributes.update');
    Route::get('/supprimer-attribut/{id}', [ProductAttributeController::class, 'destroy'])->name('attributes.destroy');

    //Category
    Route::get('/categorie', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/ajouter-categorie', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/ajouter-categorie', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/modifier-categorie/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/modifier-categorie', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/supprimer-categorie/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // Route::resource('categories', CategoryController::class);

    //Brand
    Route::get('/marque', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/ajouter-marque', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/ajouter-marque', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/modifier-marque/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/modifier-marque', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/supprimer-marque/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    // Route::resource('brands', BrandController::class);

    //client list
    Route::get('/client', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/supprimer-client/{id}', [AdminClientController::class, 'destroy'])->name('clients.destroy');

    //Order
    Route::get('/commande', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/supprimer-commande/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    //Coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/ajouter-coupon', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/ajouter-coupon', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/modifier-coupon/{id}', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::post('/modifier-coupon', [CouponController::class, 'update'])->name('coupons.update');
    Route::get('/supprimer-coupon/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');

    //Sales
    Route::get('/promotion', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/ajouter-promotion', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/ajouter-promotion', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/modifier-promotion/{id}', [SaleController::class, 'edit'])->name('sales.edit');
    Route::post('/modifier-promotion', [SaleController::class, 'update'])->name('sales.update');
    Route::get('/supprimer-promotion/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');

    //rating
    Route::get('/rating', [RatingController::class, 'index'])->name('ratings.index');
    Route::get('/supprimer-rating/{id}', [RatingController::class, 'destroy'])->name('ratings.destroy');

    //review
    Route::get('/commentaire', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/supprimer-review/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    //notification
    Route::get('/notification', function () {
        return view('admin.pages.notification.index')->with("notifications", Auth::user()->notifications);
    })->name('notifications.index');
});
