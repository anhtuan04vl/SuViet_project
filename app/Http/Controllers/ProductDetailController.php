<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public function product_detail($id){
        $sp = Product::where('product_id', $id)->first();
        $category = Category::where('category_id', $sp->category_id)->first();
        return view("desktop.template.product_detail", compact(['sp', 'category']));
    }
}
