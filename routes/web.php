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
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\ProductSaleController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Session;
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
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('produits', [FrontController::class, 'products'])->name('products');
Route::get('produits/filter', [FrontController::class, 'filterProducts'])->name('products.filter');
Route::get('produit/{slug}', [FrontController::class, 'productDetail'])->name('productDetail');
Route::get('produits/collection/nouveaux-produits', [FrontController::class, 'getNewProducts'])->name('products.new');
Route::get('produits/collection/meilleurs-vendus', [FrontController::class, 'getBestsellerProducts'])->name('products.bestseller');
Route::get('produits/collection/promotion', [FrontController::class, 'getSaleProducts'])->name('products.sale');


Route::get('/panier', [FrontController::class, 'cart'])->name('cart');

Route::post('panier/produit/{slug}', [FrontController::class, 'addToCart'])->name('cart.add');
Route::put('panier/{id}', [FrontController::class, 'updateCart'])->name('cart.update');
Route::delete('panier/{id}', [FrontController::class, 'deleteItemCart'])->name('cart.delete_item');
Route::post('panier/code-promo', [FrontController::class, 'couponReduction'])->name('cart.coupon');

Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/checkout/payer', [FrontController::class, 'checkoutPay'])->name('checkout.pay');

Route::get('/confirmation', [FrontController::class, 'confirmation'])->name('confirmation');







Route::get('admins/login', function () {
    Session::put('adminLoginPage', true);
    return view('admin.auth.login');
})->name('admin.login');

Route::get('admins/register', function () {
    // Session::put('adminRegisterPage', true);
    // return view('admin.auth.register');
    return redirect()->route('admin.login');
})->name('admin.register');
/***************************************************************************************** */

Route::get('/logedin', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::user()->role === 'client') {
        if (session()->has('url.intended')) {
            return redirect()->route(session()->get('url.intended'));
        }
        return redirect()->route('client.dashboard');
    }
})->middleware(['auth']);

// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

Route::middleware(['admin'])->prefix('admins')->name('admin.')->group(function () {


    Route::get('', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //Product
    Route::get('/produit', [ProductController::class, 'index'])->name('products.index');
    Route::get('/ajouter-produit', [ProductController::class, 'create'])->name('products.create');
    Route::post('/ajouter-produit', [ProductController::class, 'store'])->name('products.store');
    Route::get('/modifier-produit/{slug}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/modifier-produit/{slug}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/supprimer-produit/{slug}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/activer-produit/{slug}', [ProductController::class, 'activateProduct'])->name('products.activate');
    Route::get('/desactiver-produit/{slug}', [ProductController::class, 'desactivateProduct'])->name('products.desactivate');
    Route::get('/produit/recherche', [ProductController::class, 'findAutocomplete'])->name('products.findAutocomplete');


    //Attribute
    Route::get('/attribut', [ProductAttributeController::class, 'index'])->name('attributes.index');
    Route::get('/ajouter-attribut', [ProductAttributeController::class, 'create'])->name('attributes.create');
    Route::post('/ajouter-attribut', [ProductAttributeController::class, 'store'])->name('attributes.store');
    Route::get('/modifier-attribut/{id}', [ProductAttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('/modifier-attribut/{id}', [ProductAttributeController::class, 'update'])->name('attributes.update');
    Route::get('/supprimer-attribut/{id}', [ProductAttributeController::class, 'destroy'])->name('attributes.destroy');

    Route::post('/recuperer-attributes', [ProductAttributeController::class, 'getCategoryAttributes'])->name('attributes.category_attributes');


    //Category
    Route::get('/categorie', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/ajouter-categorie', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/ajouter-categorie', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/modifier-categorie/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/modifier-categorie/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/supprimer-categorie/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categorie/recherche', [CategoryController::class, 'findAutocomplete'])->name('categories.findAutocomplete');
    // Route::resource('categories', CategoryController::class);

    //Brand
    Route::get('/marque', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/ajouter-marque', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/ajouter-marque', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/modifier-marque/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/modifier-marque/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/supprimer-marque/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    // Route::resource('brands', BrandController::class);

    //client list
    Route::get('/client', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/supprimer-client/{id}', [AdminClientController::class, 'destroy'])->name('clients.destroy');

    //Order
    Route::get('/commande', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/commande/mettre-a-jour/{id}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/commande/mettre-a-jour/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/supprimer-commande/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    //Coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/ajouter-coupon', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/ajouter-coupon', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/modifier-coupon/{id}', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/modifier-coupon/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::get('/supprimer-coupon/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');

    //Sales
    // Route::get('/promotion', [SaleController::class, 'index'])->name('sales.index');
    // Route::get('/ajouter-promotion', [SaleController::class, 'create'])->name('sales.create');
    // Route::post('/ajouter-promotion', [SaleController::class, 'store'])->name('sales.store');
    // Route::get('/modifier-promotion/{id}', [SaleController::class, 'edit'])->name('sales.edit');
    // Route::post('/modifier-promotion', [SaleController::class, 'update'])->name('sales.update');
    // Route::get('/supprimer-promotion/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');

    //Product Sales
    Route::get('/promo', [ProductSaleController::class, 'index'])->name('product_sales.index');
    Route::get('/ajouter-promo', [ProductSaleController::class, 'create'])->name('product_sales.create');
    Route::post('/ajouter-promo', [ProductSaleController::class, 'store'])->name('product_sales.store');
    Route::get('/modifier-promo/{id}', [ProductSaleController::class, 'edit'])->name('product_sales.edit');
    Route::put('/modifier-promo/{id}', [ProductSaleController::class, 'update'])->name('product_sales.update');
    Route::get('/supprimer-promo/{id}', [ProductSaleController::class, 'destroy'])->name('product_sales.destroy');

    //stock
    Route::get('/stock', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/modifier-stock', [StockController::class, 'index'])->name('stocks.edit');

    //review
    Route::get('/commentaire', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/supprimer-review/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    //notification
    Route::get('/notification', function () {
        return view('admin.pages.notification.index')->with("notifications", Auth::user()->notifications);
    })->name('notifications.index');
});


//CUSTOMER
Route::middleware(['client'])->prefix('client')->name('client.')->group(function () {
    Route::get('', [ClientController::class, 'index']);
    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
    Route::get('/mes-info-perso', [ClientController::class, 'account'])->name('account');
    Route::post('/mes-info-perso', [ClientController::class, 'accountUpdate'])->name('account.update');
    Route::get('/commandes', [ClientController::class, 'orders'])->name('orders');
    Route::get('/commentaires', [ClientController::class, 'reviews'])->name('reviews');

    Route::post('/produit/{slug}/donner-avis', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/list-denvie', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/list-denvie/produit/{slug}/', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/suppprimer-list-denvie/produit/{id}/', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});
