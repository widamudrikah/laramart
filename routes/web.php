<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashbordController;
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

Route::get('/', function () {
    return view('welcome');
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
});
