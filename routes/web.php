<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage Redirect Logic
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Dashboard (Requires Login & Email Verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes Group
Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Back Home Route
    Route::get('/home', [BackHomeController::class, 'index'])->name('home');

    // Category Routes
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    // Sub-Category Routes
    Route::prefix('sub-category')->name('sub-category.')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('delete');
    });

    // Product Routes
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

});

require __DIR__.'/auth.php';
