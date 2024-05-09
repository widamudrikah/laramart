<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/collections', 'categories')->name('categories');
    Route::get('/collections/{category_slug}', 'products')->name('products-category');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView')->name('products-view');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function() {
    Route::controller(DashbordController::class)->group(function(){
        Route::get('dashboard', 'index');
    });

    // category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('category', 'index')->name('category-index');
        Route::get('category/create', 'create')->name('category-create');
        Route::post('category/store', 'store')->name('category-store');
        Route::get('category/edit/{id}', 'edit')->name('category-edit');
        Route::put('category/update/{id}', 'update')->name('category-update');
    });

    // Product
    Route::controller(ProductController::class)->group(function(){
        Route::get('products', 'index')->name('product-index');
        Route::get('products/create', 'create')->name('product-create');
        Route::post('products/store', 'store')->name('product-store');
        Route::get('products/edit/{id}', 'edit')->name('product-edit');
        Route::put('products/update/{id}', 'update')->name('product-update');
        Route::get('products/delete/{id}', 'destroy')->name('product-delete');
        // delete image
        Route::get('products/delete-image/{id}', 'deleteImage')->name('product-delete-image');

        // AJAX
        Route::post('product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete', 'deleteProdColorQty');
    });

    // Brand
    Route::get('/brands', App\Livewire\Admin\Brand\Index::class)->name('brands');

    // colors
    Route::controller(ColorController::class)->group(function(){
        Route::get('/colors','index')->name('colors-index');
        Route::get('/colors/create','create')->name('colors-create');
        Route::post('/colors/store','store')->name('colors-store');
        Route::get('/colors/edit/{id}','edit')->name('colors-edit');
        Route::put('/colors/update/{id}','update')->name('colors-update');
        Route::get('/colors/delete/{id}','destroy')->name('colors-delete');
    });
    

    // Slider
    Route::controller(SliderController::class)->group(function(){
        Route::get('/slider', 'index')->name('slider-index');
        Route::get('/slider/create', 'create')->name('slider-create');
        Route::post('/slider/store', 'store')->name('slider-store');
        Route::get('/slider/edit/{slider}', 'edit')->name('slider-edit');
        Route::put('/slider/edit/{slider}', 'update')->name('slider-update');
        Route::get('/slider/delete/{slider}', 'delete')->name('slider-delete');
    });
    
});
