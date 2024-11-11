<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
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
        view()->composer('*', function($view){
            $categories=Category::all();
            $view->with(compact('categories'));
        });
        view()->composer('*', function($view){
            $products=Product::all()->take(12);
            $view->with(compact('products'));
        });
        view()->composer('*', function($view){
            $collection=Product::all()->take(8);
            $view->with(compact('collection'));
        });
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
