<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function showSlider()
    {
        $listslider = Slider::all();
        
        return view('admin.template.listslider', ['listslider' => $listslider]);
       
    }

    // Lưu slider mới
    public function addslider(Request $request)
    {

        // dd($request->all());
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // Kiểm tra ảnh hợp lệ
            'is_active' => 'required|boolean',
        ]);

        // Xử lý hình ảnh
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/images'), $imageName);
        }

        // Lưu sản phẩm mới vào cơ sở dữ liệu
        try {
            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
                'is_active' => $request->is_active
            ]);

            // Trả về trang thêm sản phẩm với thông báo thành công
            return redirect()->route('addslider')->with('success', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi trong quá trình thêm sản phẩm, trả về thông báo lỗi
            return back()->withErrors(['error' => 'Có lỗi khi thêm sản phẩm. Vui lòng thử lại.'])->withInput();
        }
    }

    
    // Hiển thị form chỉnh sửa slider
    public function edit($id)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu
        $updateslider = Slider::where('id', $id)->first();
    
        if (!$updateslider) {
            return redirect()->route('listslider')->with('error', 'Slider không tồn tại.');
        }
    
        // Trả về view với dữ liệu sản phẩm
        return view('admin.template.updateslider', compact('updateslider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // Kiểm tra ảnh hợp lệ
            'is_active' => 'required|boolean',
        ]);

        // Tìm slider cần cập nhật
        $updateslider = Slider::where('id', $id)->first();

        if (!$updateslider) {
            return redirect()->route('admin.template.listslider')->with('error', 'Slider not found.');
        }

        // Xử lý hình ảnh
        $imageName = $updateslider->image;
        if ($request->hasFile('image')) {
           //xoa anh cu neu co
           if($updateslider->image && file_exists(public_path('img/images/'.$updateslider->image)))
            {
                unlink(public_path('img/images/'.$updateslider->image));
            }
            // Lưu hình ảnh vào thư mục 'img/images' và lấy tên file
            $imageName = time() . '_' . $request->image->extension();
            $request->image->move(public_path('img/images'), $imageName);
        }

        try{
            // Cập nhật slider
            $updateslider->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('listsliders')->with('success', 'Slider đã cập nhật.');
        }
        catch(\Exception $e){
            return back()->withErrors(['error' => 'Có lỗi khi cập nhật sản phẩm: ' . $e->getMessage()])->withInput();
        }
    }

    // Xoa slider
    public function destroy($id)
    {
        // Tìm slider cần xoa
        $deleteslider = Slider::where('id', $id)->first();

        if (!$deleteslider) {
            return redirect()->route('listsliders')->with('error', 'Slider not found.');
        }

        // Xoa slider
        $deleteslider->delete();

        return redirect()->route('listsliders')->with('success', 'Slider đã được xóa.');
    }

}
