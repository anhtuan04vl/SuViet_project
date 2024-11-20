<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Đảm bảo import Auth

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Kiểm tra nếu người dùng đã đăng nhập và có vai trò là admin (role == 1)
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 1) {

            return $next($request); // Cho phép tiếp tục nếu là admin
        }

        // Nếu không phải admin, chuyển hướng về trang home hoặc login
        return redirect()->route('login');
        // return redirect('desktop.template.home')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}