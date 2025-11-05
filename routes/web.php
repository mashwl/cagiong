<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Livewire\Home;
use App\Livewire\Page;
use App\Livewire\ProductPage;
use App\Models\Product;
use Firefly\FilamentBlog\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

//  Route::get('/', [PostController::class, 'index'])->name('filamentblog.post.index');
// Route::get('/', Home::class)->name('filamentblog.post.index');
Route::get('/', Home::class)->name('home');
// Route::get('/san-pham-ca-giong', ProductPage::class)->name('product.all');
Route::get('/san-pham-ca-giong/danh-muc/{category:slug}', [CategoryController::class, 'posts'])->name('category.show');
Route::get('/san-pham-ca-giong/{category:slug}/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/order', [OrderController::class, 'submit'])->name('order.submit');
Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

});
Route::get('/thong-tin/{page:slug}', Page::class) ->name('page');




