<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoryModel;
use App\Models\admin\ProductModel;
use Alert;  // Thêm dòng này vào đầu controller

class CategoryController extends Controller
{
    public function listCategory()
    {
       // Lấy danh sách tất cả danh mục kèm theo số lượng sản phẩm trong mỗi danh mục
        $catelist = CategoryModel::withCount('products')->get();
        return view('admin.template.listcategory', compact('catelist'));
    }

    // ẩn đi danh mục
    public function updateStatus(Request $request)
{
    // Kiểm tra xem 'id_category' và 'is_active' có tồn tại trong request hay không
    $validated = $request->validate([
        'id_category' => 'required|integer',  // Kiểm tra 'id_category' thay vì 'id'
        'is_active' => 'required|boolean',
    ]);

    // Tìm kiếm danh mục bằng 'id_category'
    $category = CategoryModel::findOrFail($validated['id_category']);

    // Kiểm tra xem danh mục có sản phẩm nào không
    if ($category->products_count > 0 && !$validated['is_active']) {
        // Nếu có sản phẩm và muốn ẩn, trả về lỗi
        return response()->json(['message' => 'Không thể ẩn danh mục có sản phẩm'], 400);
    }

    // Nếu không có sản phẩm hoặc đang bật trạng thái, tiếp tục thay đổi trạng thái
    $category->is_active = $validated['is_active'];
    $category->save();

    return response()->json(['message' => 'Đã cập nhật trạng thái danh mục']);
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
           // Sử dụng session để trả thông báo khi danh mục đã tồn tại
        session()->flash('alert', [
            'type' => 'warning',
            'title' => 'Cảnh báo!',
            'message' => 'Danh mục đã tồn tại!'
        ]);
        return redirect()->route('listcategory');
        }
    
        // Xử lý hình ảnh
        $imageName = $this->handleImageUpload($request);
    
        try {
            CategoryModel::create([
                'name' => $request->name,
                'images' => $imageName,
            ]);
            // Trả về thông báo thành công
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Thành công!',
            'message' => 'Thêm danh mục thành công!'
            ]);
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
        session()->flash('alert', [
            'type' => 'error',
            'title' => 'Lỗi!',
            'message' => 'Có lỗi xảy ra khi thêm danh mục.'
        ]);
        }
        return redirect()->route('listcategory');
    }
    

//xu ly hinh anh 
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->move(public_path('img/images'), $imageName);
            return $imageName;
        }
        return null;
    }
    
    public function edit($category_id)
    {
        // Lấy thống tin cơ sở dữ liệu cơ sở dữ liệu
        $updatecategory = CategoryModel::where('category_id', $category_id)->first();

        if (!$updatecategory) {
            return redirect()->route('listcategory')->with('error', 'Danh mục không tồn tại.');
        }
        // Trả về view với dữ liệu sản phẩm
        return view('admin.template.updatecategory', compact('updatecategory'));
    }

    public function update(Request $request, $category_id)
    {
        //xac thuc du lieu nhan vao
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Kiem tra danh muc da ton tai
        $existingCategory = CategoryModel::where('name', $request->name)->where('category_id', '!=', $category_id)->first();

        if ($existingCategory) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Danh mục đã tồn tại!'
            ]);
            return redirect()->route('listcategory');
        }

        // Xu ly hinh anh
        $imageName = $this->handleImageUpload($request);

        try {
            CategoryModel::where('category_id', $category_id)->update([
                'name' => $request->name,
                'images' => $imageName,
            ]);
            // Trả về thông báo thành công
            session()->flash('alert', [
                'type' => 'success',
                'title' => 'Thành công!',
                'message' => 'Cập nhật mục thành công!'
            ]);
            return redirect()->route('listcategory');
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
            session()->flash('alert', [
                'type' => 'error',
                'title' => 'Lỗi!',
                'message' => 'Có lỗi xảy ra khi cập nhật danh mục.'
            ]);
            return redirect()->route('listcategory');
        }
    }

    

}

