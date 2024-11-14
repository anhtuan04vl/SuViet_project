<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductModel;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Phương thức xử lý đăng nhập
    public function login(Request $request)
    {
        // dd($request->all());
        // Xác thực đầu vào
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Lấy thông tin đăng nhập từ request
        $credentials = $request->only('username', 'email', 'password');

        // Thử đăng nhập
        if (Auth::guard('admin')->attempt($credentials, $request->has('rememberMe'))) {
            // Nếu đăng nhập thành công
            return redirect()->route('admin'); // Chuyển đến trang dashboard của admin
        } else {
            // Nếu đăng nhập thất bại, trả về thông báo lỗi
            return back()->withErrors([
                'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
            ])->withInput($request->only('password')); // Lưu lại giá trị password đã nhập
        }
    }

    //xu ly logout
    // public function logout(Request $request)
    // {
    //     // Đăng xuất người dùng hiện tại
    //     Auth::guard('admin')->logout();

    //     // Xóa tất cả session và cookies liên quan đến người dùng
    //     $request->session()->invalidate();

    //     // Hủy tất cả các session liên quan đến người dùng
    //     $request->session()->regenerateToken();

    //     // Chuyển hướng về trang đăng nhập
    //     return redirect()->route('login'); // Điều chỉnh đường dẫn đến trang đăng nhập của bạn
    // }




}
