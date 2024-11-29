<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    public function showlistlogo()
    {
       $listlogo = Logo::all();
       return view('admin.template.listlogo', compact('listlogo'));
    }
}
