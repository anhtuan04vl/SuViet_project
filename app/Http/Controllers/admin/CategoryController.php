<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoryModel;
use App\Models\admin\ProductModel;


class CategoryController extends Controller
{
    public function listCategory()
    {
       // Lấy danh sách tất cả danh mục kèm theo số lượng sản phẩm trong mỗi danh mục
        $catelist = CategoryModel::withCount('products')->get();
        return view('admin.template.listcategory', compact('catelist'));
    }

    //show form them danh muc
    public function create()
    {
        return view('admin.template.addcategory');
    }   

    //them danh muc
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Kiểm tra nếu danh mục đã tồn tại
        $existingCategory = CategoryModel::where('name', $request->name)->first();

        if ($existingCategory) {
            return redirect()->route('listcategory')->with('error', 'Danh mục đã tồn tại.');
        }

        // Xử lý hình ảnh
        $imageName = $this->handleImageUpload($request);

        try {
            CategoryModel::create([
                'name' => $request->name,
                'images' => $imageName,
            ]);
            return redirect()->route('listcategory')->with('success', 'Thêm danh mục thành công.');
        } catch (\Exception $e) {
            return redirect()->route('listcategory')->with('error', 'Thêm danh mục không thành công.');
        }
    }

    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->move(public_path('img/images'), $imageName);
            return $imageName;
        }
        return null;
    }

}

