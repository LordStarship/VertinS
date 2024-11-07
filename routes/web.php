<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AccountsController;

Route::get('/', function (){
    return view('index');
})->name('index');

Route::get('/products', [ProductsController::class, 'index'])->name('products');;
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

Route::get('/account', [AccountsController::class, 'index'])->name('accounts');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/signup-page', [SignUpController::class, 'index'])->name('signup.page');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');