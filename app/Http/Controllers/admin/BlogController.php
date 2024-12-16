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

    public function addBlog(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        // Xử lý hình ảnh
        $imageName = null;
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->move(public_path('img/images'), $imageName);
        }

        // Thêm bài viết vào database
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'users_id' => auth()->id(), // ID người dùng đang đăng nhập
            'images' => $imageName,
            'is_active' => $request->is_active,
        ]);

        // Redirect về trang nào đó kèm thông báo thành công
        return redirect()->back()->with('success', 'Bài viết đã được thêm thành công!');
    }
}
