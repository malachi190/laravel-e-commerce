<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\User;

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

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/redirect', function(){
    $user_type = Auth::user()->user_type;
    if($user_type == '1'){
        return redirect()->route('dashboard');
    }else{
        $products = Products::all();
        return view('welcome', compact('products'));
    }
});

// Category Routes
Route::prefix('/category')->group(function(){
    Route::get('/main_category', [CategoriesController::class, 'main_category'])->name('main.category');
    Route::post('/add_category', [CategoriesController::class, 'add_category'])->name('add.category');
    Route::get('/delete_category/{id}', [CategoriesController::class, 'delete_category'])->name('delete_category');
});

// Product Routes
Route::prefix('/products')->group(function(){
    Route::get('/add_product',[ProductsController::class, 'add_product'])->name('add_product');
    Route::post('/add_product_data', [ProductsController::class, 'add_product_data'])->name('add_product_data');
    Route::get('/all_products', [ProductsController::class, 'view_all_products'])->name('all_products');
    Route::get('/edit_product/{id}', [ProductsController::class, 'edit_products'])->name('edit_products');
    Route::put('/update_product/{id}', [ProductsController::class, 'update_product'])->name('update_product');
    Route::get('/delete_product/{id}', [ProductsController::class, 'delete_product'])->name('delete_product');
    Route::get('/product_details/{id}', [ProductsController::class, 'product_details'])->name('product_details');
    Route::get('/cart', [ProductsController::class, 'all_cart'])->name('product.cart');
    Route::post('/add_to_cart/{id}', [ProductsController::class, 'add_cart'])->name('add_to_cart');
});
require __DIR__.'/auth.php';
