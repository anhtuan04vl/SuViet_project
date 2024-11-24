<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductModel;
use App\Models\admin\CategoryModel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct(Request $request)
    {
       // Tạo truy vấn cơ bản lấy sản phẩm mới nhất
        $query = ProductModel::with('category')->get();

        $query = ProductModel::query();

        // Kiểm tra nếu có giá trị sắp xếp theo giá
        if ($request->has('sort_price')) {
            $sortPrice = $request->input('sort_price');
            
            if ($sortPrice == 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sortPrice == 'desc') {
                $query->orderBy('price', 'desc');
            }
        }

       // Lấy danh sách sản phẩm đã được áp dụng sắp xếp và giới hạn
        $listproduct = $query->latest()->take(12)->get();

        // Kiểm tra xem có phải là request AJAX không
        if ($request->ajax()) {
            // Trả về HTML đã được render của bảng sản phẩm
            $html = view('admin.partials.product_table', compact('listproduct'))->render();
            return response()->json(['html' => $html]);
        }
       
        return view('admin.template.listproduct', ['listproduct' => $listproduct]);
    }
    
    public function newProducts()
    {
        // Lấy sản phẩm mới nhất (theo thứ tự created_at giảm dần)
        $newproducts = ProductModel::with('category')->latest()->take(10)->get(); // Lấy 10 sản phẩm mới nhất

        return view('admin.template.dashboard', ['newproducts' => $newproducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        // dd($request->all());
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'gia_cu' => 'required|numeric',
            'short_description' => 'required|string',
            'category_id' => 'required|exists:categories,category_id',  // Kiểm tra category_id có tồn tại trong bảng categories
            'quantity' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // Kiểm tra ảnh hợp lệ
            'is_show' => 'required|boolean',  // Kiểm tra trạng thái (hiện/ẩn)
        ]);

        // Xử lý hình ảnh
        $imageName = null;
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img/images'), $imageName);
        }

        // Lưu sản phẩm mới vào cơ sở dữ liệu
        try {
            ProductModel::create([
                'name' => $request->name,
                'price' => $request->price,
                'gia_cu' => $request->gia_cu,
                'short_description' => $request->short_description,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'img' => $imageName,  // Lưu tên file ảnh vào cột `img`
                'is_show' => $request->is_show,  // Lưu trạng thái sản phẩm
            ]);

            // Trả về trang thêm sản phẩm với thông báo thành công
            return redirect()->route('addproduct')->with('success', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi trong quá trình thêm sản phẩm, trả về thông báo lỗi
            return back()->withErrors(['error' => 'Có lỗi khi thêm sản phẩm. Vui lòng thử lại.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCateOfProduct()
    {
        // $creproduct = ProductModel::where('product_id', $product_id)->first();

        // if (!$creproduct) {
        //     return redirect()->route('listproduct')->with('error', 'Sản phẩm không tồn tại.');
        // }

        return view('admin.template.addproduct');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu
        $updateproduct = ProductModel::where('product_id', $product_id)->first();
    
        if (!$updateproduct) {
            return redirect()->route('listproduct')->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Trả về view với dữ liệu sản phẩm
        return view('admin.template.updateproduct', compact('updateproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {

        // dd($request->all()); // Xem dữ liệu gửi đến

       // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'gia_cu' => 'nullable|numeric',
            'short_description' => 'required|string',
            'category_id' => 'required|exists:categories,category_id',
            'quantity' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_show' => 'required|boolean',
        ]);

        // Tìm sản phẩm cần cập nhật
        $product = ProductModel::where('product_id', $product_id)->first();

        if (!$product) {
            return redirect()->route('listproduct')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xử lý hình ảnh nếu có
        $imageName = $product->img; // Giữ lại ảnh cũ nếu không thay đổi
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($product->img && file_exists(public_path('img/images/' . $product->img))) 
            {
                unlink(public_path('img/images/' . $product->img));
            }
            // Lưu ảnh mới
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img/images'), $imageName);
        }

        // Cập nhật thông tin sản phẩm
        try {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'gia_cu' => $request->gia_cu,
                'short_description' => $request->short_description,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'img' => $imageName,  // Lưu tên file ảnh vào cột `img`
                'is_show' => $request->is_show,  // Cập nhật trạng thái hiển thị
            ]);

            return redirect()->route('listproduct')->with('success', 'Sản phẩm đã được cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi khi cập nhật sản phẩm: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /// Tìm sản phẩm theo ID
        $product = ProductModel::find($id);     

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return redirect()->route('listproduct')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xóa sản phẩm
        $product->delete();

        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('listproduct')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    
    //xoa tat ca
    
}


 