<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AccountsController;

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


Route::get('/about', function () {
    return view('about',['title' => 'About Us']);
});

Route::get('/', function () {
    return view('avalestial',['title' => "Ava'Lestial Store"]);
})->name('home');

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
    
    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
    
    Route::put('/admins/{id}', [AccountsController::class, 'updateAdmin'])->name('admins.update');
    Route::post('/admins/store', [AccountsController::class, 'store'])->name('admins.store');
    Route::delete('/admin/{admin}', [AccountsController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-form', [LoginController::class, 'login'])->name('login.form');
Route::get('/signup-page', [SignUpController::class, 'index'])->name('signup.page');
Route::post('/signup', [SignUpController::class, 'signup'])->name('signup');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');