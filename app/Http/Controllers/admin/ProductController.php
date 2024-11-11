<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductModel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct()
    {
        $products = ProductModel::all();

        return view('admin.template.listproduct', ['products' => $products]);
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
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'short_description' => 'required|string',
        'category_id' => 'required',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'img' => $imageName,  // Lưu tên file ảnh vào cột `img`
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


 