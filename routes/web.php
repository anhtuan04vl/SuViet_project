<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Admin Routes
use App\Http\Controllers\admin\ProductController;
use App\Models\admin\ProductModel;
use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderAdminController;

// Web routes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Client Routes
Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/product', [SanphamController::class,'product'])->name('product');
    Route::get("/product_detail/{product_id}", [ProductDetailController::class, "product_detail"])->name("product_detail");
    Route::get('/listcate/{name}', [SanphamController::class, 'listcate'])->name('listcate');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Order routes
    Route::get('/order/{users_id?}', [OrderController::class, 'showOrder'])->name('order');
    Route::post('/order/add', [OrderController::class, 'store'])->name('order.add');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    // Cart routes
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::delete('/cart/delete/{cart_id}', [CartController::class, 'destroy']);
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/delete-item', [CartController::class, 'deleteItem'])->name('cart.deleteItem');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/{users_id}', [CartController::class, 'showCart'])->name('show_cart');
    Route::post('/apply-coupon', [CartController::class, 'applyCoupon']);

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

    //User
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Login admin
Route::get('admin/loginAdmin', function () {
    return view('admin.auth.login'); // Trỏ đến trang đăng nhập
})->name('login');
Route::post('admin/login', [AdminController::class, 'login'])->name('login.submit');
Route::get('/forgot-password', [AdminController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AdminController::class, 'sendResetPassword'])->name('password.email');

// Admin Routes                                thay doi kernel dang ky truc tiep ben route web!
Route::prefix('/admin')->middleware(['auth:admin', AdminMiddleware::class])->group(function () {
    //logout
    Route::post('/logoutAdmin', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    //dashboard
    Route::get('/', [ProductController::class, 'newProducts'])->name('admin');
    //end dashboard

    //User----------------------------------------------------------------------------------

    Route::get('/listaccount', [UserController::class, 'listUsers'])->name('listaccount');

    //end user

    //Order-----------------------------------------------------------------------------------

    Route::get('/donhang', [OrderAdminController::class, 'showlistorders'])->name('donhang');
    // Route::post('/admin/donhang/update-status/{orderId}', [OrderAdminController::class, 'updateStatus'])->name('order.update-status');
    Route::get('/donhangchitietAdmin/{order_id}', [OrderAdminController::class, 'showorderdetail'])->name('admin.donhangchitiet');

    //end order

    //Category--------------------------------------------------------------------------------

    Route::get('/listcategory', [CategoryController::class, 'listCategory'])->name('listcategory');
    Route::get('/addcategory', [CategoryController::class, 'create'])->name('addcategory');
    Route::post('/storecategory', [CategoryController::class, 'store'])->name('store.category');


    //end category

    //Products--------------------------------------------------------------------------------

    Route::get('/listproduct', [ProductController::class, 'listProduct'])->name('listproduct');
    Route::post('/listproduct/update-show-status', [ProductController::class, 'updateShowStatus'])->name('update.show.status');
    // Route để hiển thị form thêm
    Route::get('/addproduct', [ProductController::class, 'showCateOfProduct'])->name('addproduct');
    Route::post('/storeproduct', [ProductController::class, 'store'])->name('store.product');
    // Route để hiển thị form chỉnh sửa
    Route::get('/updateproduct/{product_id}', [ProductController::class, 'edit'])->name('updateproduct');
    Route::put('/updateproduct/{product_id}', [ProductController::class, 'update'])->name('product.update');


    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    
    //end products

    //Category--------------------------------------------------------------------------------

    Route::get('/listcategory', [CategoryController::class, 'listCategory'])->name('listcategory');

    //end category


    //Slider-----------------------------------------------------------------------------------
    Route::get('/listslider',[SliderController::class, 'showSlider'])->name('listsliders');

    Route::get('/addslider', function () {
        return view('admin.template.addslider');
    })->name('addslider');
    Route::post('/storeslider', [SliderController::class, 'addslider'])->name('addslider.slider');
    // Route để hiển thị form chỉnh sửa
    Route::get('/updateslider/{id}',[SliderController::class, 'edit'])->name('updateslider');
    Route::put('/updateslider/{id}', [SliderController::class, 'update'])->name('slider.update');

    Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    //end slider---------------------------------------------------------------------------------
});
require __DIR__.'/auth.php';