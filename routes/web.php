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
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LogoController;
use App\Http\Controllers\admin\BlogController;

// Web routes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CommentController;

// Client Routes
Route::group(['name'=>'desktop'],function () {

    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/product', [SanphamController::class,'product'])->name('product');
    Route::get("/product_detail/{product_id}", [ProductDetailController::class, "product_detail"])->name("product_detail");
    Route::get('/listcate/{name}', [SanphamController::class, 'listcate'])->name('listcate');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Order routes
    Route::get('/order/{users_id?}', [OrderController::class, 'showOrder'])->name('order');
    Route::post('/order/add', [OrderController::class, 'store'])->name('order.add');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    //oder payment
    Route::post('/payment', [OrderController::class, 'payment_vnpay'])->name('payment');
    Route::get('/vnpay-return', [OrderController::class, 'vnpayReturn'])->name('vnpay.return');


    // Cart routes
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::delete('/cart/delete/{cart_id}', [CartController::class, 'destroy']);
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove-product', [CartController::class, 'removeProduct'])->name('cart.removeProduct');
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

//binhluan
//Comment
Route::prefix('api')->group(function () {
    Route::get('/comments/product/{product_id}', [CommentController::class, 'product']);
    Route::resource('comments', CommentController::class);
});

// Check user for Comment
Route::get('/api/check-login', function () {
    if (Auth::check()) {
        return response()->json(['isLoggedIn' => true, 'user' => Auth::user()]);
    }
    return response()->json(['isLoggedIn' => false]);
});

//withlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::post('/wishlist/remove-product', [WishlistController::class, 'removeProduct'])->name('wishlist.remove');
});

//Profile
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
        // Route::get('/', [DashboardController::class, 'newProducts'])->name('dashboard');
        //thong bao
        // Hiển thị thông báo chưa đọc
        Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('admin.navbar');
        Route::get('/notifications/{notificationId}/mark-as-read', [NotificationController::class, 'markNotificationAsRead'])->name('notifications.markAsRead');
        //end thong bao
        Route::get('/', [DashboardController::class, 'showthongke',])->name('admin');


    //end dashboard

    //logo
        Route::get('/listlogo', [LogoController::class, 'showlistlogo'])->name('listlogo');
    //end logo

    //User----------------------------------------------------------------------------------

    Route::get('/listaccount', [UserController::class, 'listUsers'])->name('listaccount');
    Route::get('/updateaccount/{users_id}', [UserController::class, 'updateAccount'])->name('updateaccount');
    Route::put('/updateaccount/{users_id}', [UserController::class, 'updateAdminUser'])->name('user.updateAdminUser');

    //end user

    //Order-----------------------------------------------------------------------------------

    Route::get('/donhang', [OrderAdminController::class, 'showlistorders'])->name('donhang');
    // Route::post('/admin/donhang/update-status/{orderId}', [OrderAdminController::class, 'updateStatus'])->name('order.update-status');
    Route::get('/donhangchitietAdmin/{order_id}', [OrderAdminController::class, 'showorderdetail'])->name('admin.donhangchitiet');
    Route::post('/update-order-status/{order_id}', [OrderAdminController::class, 'updateStatus'])->name('update.order.status');

    // Route::get('/order-statistics', [OrderAdminController::class, 'statistics'])->name('order.statistics');

    //end order

    //Category--------------------------------------------------------------------------------

    Route::get('/listcategory', [CategoryController::class, 'listCategory'])->name('listcategory');
    Route::get('/addcategory', [CategoryController::class, 'create'])->name('addcategory');
    Route::post('/storecategory', [CategoryController::class, 'store'])->name('store.category');
    // Route để hiển thị form chỉnh sửa
    Route::get('/updatecategory/{category_id}',[CategoryController::class, 'edit'])->name('updatecategory');
    Route::put('/updatecategory/{category_id}', [CategoryController::class, 'update'])->name('category.update');
    //status cate
    Route::post('/update-category-status', [CategoryController::class, 'updateStatus'])->name('category.updateStatus');



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

    //Blogs-------------------------------------------------------------------------------------
    Route::get('/listblog', [BlogController::class, 'showlistblog'])->name('listblog');

    Route::get('/addblog', function () {
        return view('admin.template.addblogs');
    })->name('addblogs');
    Route::post('/addblogs', [BlogController::class, 'addBlog'])->name('store.blog');
    // Route để hiển thị form chỉnh sửa
    // Route::get('/updateblog/{id}',[BlogController::class, 'edit'])->name('updateblog');
    // Route::put('/updateblog/{id}', [BlogController::class, 'update'])->name('blog.update');
    //end blog
    
});
require __DIR__.'/auth.php';