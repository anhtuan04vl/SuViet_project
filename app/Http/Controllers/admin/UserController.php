<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin\UserModel; 

class UserController extends Controller
{
    public function listUsers()
    {
        $users = User::all();

        return view('admin.template.listaccount', compact('users'));
    }

    //show form updateaccount
    public function updateAccount($id)
    {
       $formupdateuser = User::with(['contacts'])->where('users_id', $id)->first();

       if(!$formupdateuser)
       {
           return redirect()->route('listaccount')->with('error', 'Tài khoản khong ton tai');
       }
       
       return view('admin.template.updateAccount', compact('formupdateuser'));
    }

    //xu ly updateaccount
    public function updateAdminUser(Request $request, $users_id)
    {
        // Xác thực dữ liệu nhận vào
        $request->validate([
            'fullname' => 'nullable|string|max:255',  // Để cho phép trường này là optional
            'email' => 'nullable|string|email|max:255',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',  // Không bắt buộc khi không thay đổi
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // Hình ảnh tùy chọn
            'role' => 'nullable|boolean',  // Vai trò có thể thay đổi, nếu không cần thì bỏ qua
        ]);
        
        // Tìm người dùng cần cập nhật
        $usercurrent = User::where('users_id', $users_id)->first();
    
        if (!$usercurrent) {
            return redirect()->route('listaccount')->with('error', 'Tài khoản không tồn tại');
        }
    
        // Xử lý hình ảnh nếu có
        $imageName = $this->handleImageUpload($request) ?? $usercurrent->images;
    
        try {
            // Cập nhật thông tin người dùng
            $usercurrent->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),  // Mã hóa mật khẩu
                'images' => $imageName,  // Cập nhật tên hình ảnh
                'role' => $request->role,  // Cập nhật vai trò
            ]);
    
            return redirect()->route('listaccount')->with('success', 'Cập nhật tài khoản thành công');
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return redirect()->route('listaccount')->with('error', 'Cập nhật tài khoản thất bại: ' . $e->getMessage());
        }
    }
    //xu ly hinh anh full 
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
