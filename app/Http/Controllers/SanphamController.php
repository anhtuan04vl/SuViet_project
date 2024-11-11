<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class SanphamController extends Controller
{
    public function product(){
        return view('desktop.template.product');
    }
    public function listcate($name){
        $category = Category::where("name",$name)->first();
        $product = Product::where("category_id", $category->category_id)->get();
        return view("desktop.template.listcate", compact('product', 'category'));
    }
}
