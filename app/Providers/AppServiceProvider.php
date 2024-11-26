<?php

namespace App\Providers;

use App\Models\admin\UserModels;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\admin\SliderController;
use App\Models\Slider;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('products', Product::all());
        view()->composer('*', function($view){
            $categoriess=Category::all();
            $view->with(compact('categoriess'));
        });
        view()->composer('*', function($view){
            $products=Product::all()->take(4);
            $view->with(compact('products'));
        });
        //lấy tất cả sản phẩm admin
        view()->composer('*', function($view){
            $listproductss=Product::all();
            $view->with(compact('listproductss'));
        });
        // end lấy tất cả sản phẩm admin
        //show infor user admin
        view()->composer('*', function($view){
            $userss= User::all();
            $view->with(compact('userss'));
        });
        //lay tat ca don hang
        view()->composer('*', function($view){
            $ordershow=Order::all();
            $view->with(compact('ordershow'));
        });
        //end lay tat ca don hang
        //slider
        view()->composer('*', function($view){
            $listslidershow = Slider::where('is_active', 1)->get();
            $view->with(compact('listslidershow'));
        });
        //end slider
        view()->composer('*', function($view){
            $collection=Product::all()->take(8);
            $view->with(compact('collection'));
        });


        //show số lượng sp trong cart
        view()->composer('*', function ($view) {
            $userId = Auth::id();
            $cartCount = 0;

            if ($userId) {
                $cart = Cart::where('users_id', $userId)->first();
                if ($cart) {
                    $cartCount = CartDetail::where('cart_id', $cart->cart_id)->sum('quantity');
                }
            }

            $view->with('cartCount', $cartCount);
        });

        //cart
        // view()->composer('*', function($view){
        //     $cart=Cart::all();
        //     $totalPrice = 0;

        //     // Duyệt qua từng giỏ hàng trong collection
        //     foreach ($cart as $item) {
        //         // Duyệt qua từng chi tiết trong giỏ hàng
        //         foreach ($item->details as $detail) {
        //             $totalPrice += $detail->price * $detail->quantity;
        //         }
        //     }

        //    // Chia sẻ dữ liệu cart và totalPrice với tất cả các view
        // $view->with(compact('cart', 'totalPrice'));
        // });
        // end cart
        view()->composer('*', function($view){
            $sortOption = request()->input('sort', 'default');
            $searchQuery = request()->input('query', ''); // Lấy từ khóa tìm kiếm
            $categories = Category::all()->take(8);

            $allProductQuery = Product::query();

            // Thêm điều kiện tìm kiếm nếu có từ khóa
            if (!empty($searchQuery)) {
                $allProductQuery->where('name', 'LIKE', "%{$searchQuery}%");
            }

            switch ($sortOption) {
                case 'price_asc':
                    $allProductQuery->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $allProductQuery->orderBy('price', 'desc');
                    break;
                case 'sold':
                    $allProductQuery->orderBy('sold', 'desc');
                    break;
                case 'votes':
                    $allProductQuery->orderBy('votes', 'desc');
                    break;
                default:
                    $allProductQuery->orderBy('created_at', 'desc');
                    break;
            }

            $allProduct = $allProductQuery->paginate(12)->appends([
                'sort' => $sortOption,
                'query' => $searchQuery
            ]);
            $view->with(compact('allProduct', 'sortOption', 'searchQuery', 'categories'));
        });
    }
}