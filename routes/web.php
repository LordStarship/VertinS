<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/', function (){
    return view('index');
})->name('index');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/index2', [HomeController::class, 'index2'])->name('index2');
Route::post('/home/add', [HomeController::class, 'add'])->name('home.add');
Route::get('/home/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home/update/{id}', [HomeController::class, 'update'])->name('home.update');
Route::delete('/home/delete/{id}', [HomeController::class, 'delete'])->name('home.delete');

Route::post('/login', [LoginController::class, 'login'])->name('login');