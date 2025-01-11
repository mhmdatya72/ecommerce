<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CategoryController;

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

Route::group([
    'middleware' =>[ 'auth:admin'],
    'as' => 'dashboard.', // Add a dot here
    'prefix' => 'admin/dashboard',
], function () {


Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::resource('/categories', CategoryController::class)->except('show');

    Route::get('/categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');

    // Use lowercase and plural for resources
    Route::resource('products', ProductController::class)->except(['show']);

    Route::resource('orders', CategoryController::class);



// Route::get('products', [ProductController::class, 'index']);

// عرض صفحة إنشاء منتج جديد (Create)
// Route::get('/products/create', [ProductController::class, 'create'])->name('dashboard.products.create');

// إضافة منتج جديد (Store)
// Route::post('/products', [ProductController::class, 'store'])->name('dashboard.products.store');

// عرض صفحة تعديل منتج (Edit)
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('dashboard.products.edit');

// تعديل منتج (Update)
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('dashboard.products.update');

// حذف منتج (Destroy)
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('dashboard.products.destroy');

});