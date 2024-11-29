<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin\UserModel; 
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function listUsers()
    {
        $users = User::paginate(8);

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
        // Xác thực cơ bản
        $validatedData = $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role' => 'nullable|boolean',
        ]);
        // Tìm người dùng hiện tại
        $usercurrent = User::where('users_id', $users_id)->first();

        if (!$usercurrent) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Tài khoản không tồn tại!'
            ]);
            return redirect()->route('updateaccount', ['users_id' => $users_id]);
        }

        // Kiểm tra trùng lặp fullname
        if (User::where('username', $request->username)
            ->where('users_id', '!=', $users_id)
            ->exists()) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Tên này đã được sử dụng. Vui lòng chọn tên khác.'
            ]);
            return redirect()->route('updateaccount', ['users_id' => $users_id]);
        }

        // Kiểm tra trùng lặp email
        if (User::where('email', $request->email)
            ->where('users_id', '!=', $users_id)
            ->exists()) {
            session()->flash('alert', [
                'type' => 'warning',
                'title' => 'Cảnh báo!',
                'message' => 'Email này đã tồn tại. Vui lòng chọn email khác.'
            ]);
            return redirect()->route('updateaccount', ['users_id' => $users_id]);
        }

        // Kiểm tra mật khẩu nếu có nhập vào
        if ($request->filled('password')) {
            // Kiểm tra các yêu cầu khác (chữ hoa, chữ thường, số)
            $passwordValidation = preg_match('/[A-Z]/', $request->password) && 
                                preg_match('/[a-z]/', $request->password) && 
                                preg_match('/[0-9]/', $request->password);

            if (!$passwordValidation) {
                session()->flash('alert', [
                    'type' => 'warning',
                    'title' => 'Cảnh báo!',
                    'message' => 'Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường và 1 số.'
                ]);
                return redirect()->route('updateaccount', ['users_id' => $users_id]);
            }
        }

        // Xử lý hình ảnh nếu có
        $imageName = $this->handleImageUpload($request) ?? $usercurrent->images;

        try {
            // Chuẩn bị dữ liệu để cập nhật
            $dataToUpdate = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' => $request->username,
                'images' => $imageName,
                'role' => $request->role,
            ];

            if (!empty($request->password)) {
                $dataToUpdate['password'] = bcrypt($request->password);
            }

            // Cập nhật thông tin
            $usercurrent->update($dataToUpdate);

            session()->flash('alert', [
                'type' => 'success',
                'title' => 'Thành công!',
                'message' => 'Cập nhật tài khoản thành công!'
            ]);

            return redirect()->route('listaccount');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'title' => 'Lỗi!',
                'message' => 'Đã xảy ra lỗi khi cập nhật tài khoản: ' . $e->getMessage()
            ]);

            return redirect()->route('updateaccount', ['users_id' => $users_id]);
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
