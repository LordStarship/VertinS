<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AccountsController;

// Route::get('/', function () {
//     return view('home', ['title' => 'Home Page']);
// });

Route::get('/about', function () {
    return view('about',['title' => 'About Us']);
});

Route::get('/', function () {
    return view('avalestial',['title' => "Ava'Lestial Store"]);
});

Route::get('/contact', function () {
    return view('contact',['title' => 'Contact Us']);
});

Route::get('/category', function () {
    return view('category',['title' => 'Category Page']);
});

Route::get('/product', function () {
    return view('product',['title' => 'Product Details']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountsController::class, 'index'])->name('accounts');
    Route::put('/account/update', [AccountsController::class, 'updateCurrentAdmin'])->name('account.update');
    
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    
    Route::put('/admins/{id}', [AccountsController::class, 'updateAdmin'])->name('admins.update');
    Route::post('/admins/store', [AccountsController::class, 'store'])->name('admins.store');
    Route::delete('/admin/{admin}', [AccountsController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-form', [LoginController::class, 'login'])->name('login.form');
Route::get('/signup-page', [SignUpController::class, 'index'])->name('signup.page');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');