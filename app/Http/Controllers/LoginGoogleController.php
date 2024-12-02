<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPunittest\Event\Code\Throwable;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginGoogleController extends Controller
{
    public function Googlelogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function GoogleAuth()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Tìm người dùng với google_id
            $finduser = User::where('google_id', $user->getId())->first();

            // Nếu người dùng đã tồn tại
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                // Nếu người dùng chưa tồn tại, tạo mới
                $newUser = User::create([
                    'fullname' => $user->name,  // Gán tên từ Google vào fullname
                    'username' => $user->getNickname() ?: $user->getName(), // Tạo username từ nickname hoặc tên
                    'email' => $user->getEmail(),
                    'password' => Hash::make('SuViet@123'), // Mật khẩu mặc định
                    'google_id' => $user->getId(),
                    'images' => $user->getAvatar(),  // Nếu có avatar từ Google, lưu vào images
                    'role' => 0,  // Mặc định là user
                ]);

                // Đăng nhập người dùng mới và chuyển hướng
                if($newUser) {
                    Auth::login($newUser);
                    return redirect('/');
                }
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


}
