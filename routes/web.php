<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/Supprimer-produit/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    //Category
    // Route::get('/categorie', [CategoryController::class, 'index'])->name('categories.index');
    // Route::get('/ajouter-categorie', [CategoryController::class, 'create'])->name('categories.create');
    // Route::post('/ajouter-categorie', [CategoryController::class, 'store'])->name('categories.store');
    // Route::get('/modifier-categorie/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route::post('/modifier-categorie', [CategoryController::class, 'update'])->name('categories.update');
    // Route::get('/Supprimer-categorie/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::resource('categories', CategoryController::class);

    //Brand
    // Route::get('/marque', [BrandController::class, 'index'])->name('brands.index');
    // Route::get('/ajouter-marque', [BrandController::class, 'create'])->name('brands.create');
    // Route::post('/ajouter-marque', [BrandController::class, 'store'])->name('brands.store');
    // Route::get('/modifier-marque/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    // Route::post('/modifier-marque', [BrandController::class, 'update'])->name('brands.update');
    // Route::get('/Supprimer-marque/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::resource('brands', BrandController::class);
});
