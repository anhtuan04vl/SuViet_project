<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validate login credentials
        $this->validateLogin($request);

        // Attempt to login using the 'web' guard
        if (Auth::guard('web')->attempt($request->only('username', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Check the role of the authenticated user
            if (Auth::guard('web')->user()->role === 0) {
                // Nếu role == 0, hướng về trang home
                return redirect()->intended('/');
            } else if(Auth::guard('web')->user()->role != 0 /* && Auth::guard('web')->user()->role === 1 */) {
                // Nếu role != 0, hướng về trang login
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Tài khoản dùng cho quản lí.');
            }
        }

        // If authentication fails, return with error
        return back()->withErrors([
            'username' => 'Tên đăng nhập không chính xác.',
            'password' => 'Mật khẩu không chính xác.',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
