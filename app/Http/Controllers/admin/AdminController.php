<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductModel;
use App\Models\User;
use App\Models\admin\Notification;


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
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:45',
                'regex:/^[a-zA-Z]/' // Bắt đầu bằng chữ cái
            ],
            'password' => [
                'required',
                'string',
                'min:8',                // Tối thiểu 8 ký tự
                // 'regex:/^[a-zA-Z]/',    // Bắt đầu bằng chữ cái
                'regex:/[0-9]/',        // Chứa ít nhất một chữ số
            ],
        ], [
            // Tùy chỉnh thông báo lỗi cho username
            'username.required' => 'Username là bắt buộc.',
            'username.string' => 'Username phải là chuỗi ký tự.',
            'username.max' => 'Username không được vượt quá 45 ký tự.',
            'username.regex' => 'Username phải bắt đầu bằng một ký tự chữ cái.',

            // Tùy chỉnh thông báo lỗi cho password
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            // 'password.regex' => 'Mật khẩu phải bắt đầu bằng chữ cái và chứa ít nhất một chữ số.',
        ]);


        // Lấy thông tin đăng nhập từ request
        $credentials = $request->only('username', 'email', 'password');

        // Thử đăng nhập
        // if (Auth::guard('admin')->attempt($credentials, $request->has('rememberMe'))) {
        //     // Nếu đăng nhập thành công
        //     return redirect()->route('admin'); // Chuyển đến trang dashboard của admin
        // } else {
        //     // Nếu đăng nhập thất bại, trả về thông báo lỗi
        //     // Nếu đăng nhập thất bại, trả về thông báo lỗi
        //     return back()->withErrors([
        //         'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        //         'password' => 'Ten dang nhap hoac mat khau khong chinh xac.',
        //     ])->withInput($request->only('username')); // Lưu lại giá trị username đã nhập
        // }

         if (Auth::guard('admin')->attempt($credentials, $request->has('rememberMe'))) {
            // Kiểm tra xem user có phải là admin không
           if (Auth::guard('admin')->user()->role != 1) {
               // Nếu không phải admin, trả về hiển thị lỗi
               return back()->withErrors(['username' => 'Bạn không có quyền truy cập.'])->withInput($request->only('username'))->withInput($request->only('username')); // Lưu lại giá trị username đã nhập;;
           }
           // Nếu đăng nhập thành công
           return redirect()->route('admin'); // Chuyển đến trang dashboard của admin
       } else {
           // Nếu đăng nhập thất bại, trả về thông báo lỗi
               return back()->withErrors(['username' => 'Bạn không có quyền truy cập.'])->withInput($request->only('username')); // Lưu lại giá trị username đã nhập;
       } 
    }
    

    //xu ly logout
    public function logoutAdmin(Request $request)
    {
        // Đăng xuất người dùng hiện tại
        Auth::guard('admin')->logout();

        // Xóa tất cả session và cookies liên quan đến người dùng
        $request->session()->invalidate();

        // Hủy tất cả các session liên quan đến người dùng
        $request->session()->regenerateToken();

        // Chuyển hướng về trang đăng nhập
        return redirect()->route('login'); // Điều chỉnh đường dẫn đến trang đăng nhập của bạn
    }


        

}