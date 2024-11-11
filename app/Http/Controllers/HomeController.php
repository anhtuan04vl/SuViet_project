<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $dsSP = Product::with('categories')->limit(8)->get();
        return view("desktop.template.home", compact(['dsSP']));
    }
}
