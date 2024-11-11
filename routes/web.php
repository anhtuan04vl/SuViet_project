<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
use App\Http\Controllers\admin\ProductController;
use App\Models\admin\ProductModel;
use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\admin\UserController;

// web routes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;

// Client Routes
Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/product', [SanphamController::class,'product'])->name('product');
    Route::get("/product_detail/{product_id}", [ProductDetailController::class, "product_detail"])->name("product_detail");
    Route::get('/listcate/{name}', [SanphamController::class, 'listcate'])->name('listcate');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/register', function () {
        return view('desktop.template.register');
    })->name('register');

    Route::get('/order', function () {
        return view('desktop.template.order');
    })->name('order');

    Route::get('/cart', function () {
        return view('desktop.template.cart');
    })->name('cart');

    Route::get('/checkout', function () {
        return view('desktop.template.checkout');
    })->name('checkout');

    Route::get('/blog', function () {
        return view('desktop.template.blog');
    })->name('blog');

    Route::get('/about', function () {
        return view('desktop.template.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('desktop.template.contact');
    })->name('contact');

    Route::get('/account', function () {
        return view('desktop.template.account');
    })->name('account');

    Route::get('/donhangchitiet', function () {
        return view('desktop.template.donhangchitiet');
    })->name('donhangchitiet');
});







// Login admin
Route::get('admin/login', function () {
    return view('admin.auth.login'); // Trỏ đến trang đăng nhập
})->name('login');
Route::post('admin/login', [AdminController::class, 'login'])->name('login.submit');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Routes                                thay doi kernel dang ky truc tiep ben route web!
Route::prefix('/admin')->middleware(['auth:admin', AdminMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('admin.template.dashboard');
    })->name('admin');

    //User----------------------------------------------------------------------------------

    Route::get('/listaccount', [UserController::class, 'listUsers'])->name('listaccount');

    //end user

    //Order-----------------------------------------------------------------------------------

    Route::get('/donhang', function () {
        return view('admin.template.donhang');
    })->name('donhang');

    //end order

    //Products--------------------------------------------------------------------------------

    Route::get('/listproduct', [ProductController::class, 'listProduct'])->name('listproduct');

    Route::get('/addproduct', function () {
        return view('admin.template.addproduct');
    })->name('addproduct');
    Route::post('/storeproduct', [ProductController::class, 'store'])->name('store.product');

    Route::get('/updateproduct', function () {
        return view('admin.template.updateproduct');
    })->name('updateproduct');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    
    //end products
});