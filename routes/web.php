<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
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
Route::get('/cleint/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //afichage
    Route::get('/produit', [ProductController::class, 'index'])->name('show_product');
    Route::get('/categorie', [CategoryController::class, 'index'])->name('show_category');
    Route::get('/marque', [BrandController::class, 'index'])->name('show_brand');

    //ajouter
    Route::get('/ajouter-produit', [ProductController::class, 'create'])->name('create_product');
    Route::get('/ajouter-categorie', [CategoryController::class, 'create'])->name('create_category');
    Route::get('/ajouter-marque', [BrandController::class, 'create'])->name('create_brand');

    //savegarder
    Route::post('/ajouter-produit', [ProductController::class, 'store'])->name('store_product');
    Route::post('/ajouter-categorie', [CategoryController::class, 'store'])->name('store_category');
    Route::post('/ajouter-marque', [BrandController::class, 'store'])->name('store_brand');
});
