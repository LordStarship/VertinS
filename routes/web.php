<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DetailController;

// Route::get('/', function () {
//     return view('home', ['title' => 'Home Page']);
// });

Route::get('/testing', function () {
    return view('testing',['title' => 'Halaman Belajar' , 'testing' =>[
        [
            'id' => 1,
            'title' =>  'Judul artikel 1',
            'author' => 'AvaLestial',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim eligendi exercitationem expedita velit similique voluptatem vero quas! Esse molestiae nisi ab illum numquam aperiam, exercitationem voluptas. Ipsam non nisi velit?'
        ],
        [
            'id' => 2,
            'title' =>  'Judul artikel 2',
            'author' => 'AvaLestials',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero aspernatur, repellendus autem sint enim molestias voluptas adipisci nam architecto consequatur illum sit officiis dicta. At deleniti est dignissimos blanditiis ut.'
        ]
    ]]);
});

Route::get('/testing/{id}', function($id){
    $post = [
        [
            'id' => 1,
            'title' =>  'Judul artikel 1',
            'author' => 'AvaLestial',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim eligendi exercitationem expedita velit similique voluptatem vero quas! Esse molestiae nisi ab illum numquam aperiam, exercitationem voluptas. Ipsam non nisi velit?'
        ],
        [
            'id' => 2,
            'title' =>  'Judul artikel 2',
            'author' => 'AvaLestials',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero aspernatur, repellendus autem sint enim molestias voluptas adipisci nam architecto consequatur illum sit officiis dicta. At deleniti est dignissimos blanditiis ut.'
        ]
        ];
    
        $post = Arr::first($post, function($post) use($id){
            return $post['id'] == $id;
        });

        return view('testings', ['title' => 'Single Post', 'testings' =>$post]);
        // dd($post);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [DetailController::class, 'index'])->name('product');
Route::post('/product/{id}/increment-message-count', [DetailController::class, 'incrementMessageCount']);

Route::get('/products-list/{category_id?}', [ListController::class, 'index'])->name('list');

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::post('/products/search-categories', [ProductController::class, 'searchCategories'])->name('products.searchCategories');

    Route::resource('categories', CategoryController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('medias', MediaController::class)->except(['create', 'edit']);

    Route::delete('pictures/{picture}', [PictureController::class, 'destroy'])->name('pictures.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-form', [LoginController::class, 'login'])->name('login.form');
Route::get('/signup-page', [SignUpController::class, 'index'])->name('signup.page');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');