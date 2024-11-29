<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showlistblog()
    {
        $listblog = Blog::all();
        return view('admin.template.listblogs', compact('listblog'));
    }
}
