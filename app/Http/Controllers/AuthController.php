<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // 1. Hiển thị form đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Nếu bạn muốn đăng ký mới tự động là user, có thể thêm 'role' => 'user' ở đây (tùy chọn vì DB đã set default)
        ]);

        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // 3. Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // 4. Xử lý đăng nhập (Đã tích hợp Bonus & THÊM PHÂN QUYỀN CHUYỂN HƯỚNG)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tạo một key duy nhất dựa trên email và địa chỉ IP của người dùng
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // Kiểm tra xem người dùng đã thử sai quá 5 lần chưa
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', "Bạn đã đăng nhập sai quá nhiều lần. Vui lòng thử lại sau {$seconds} giây.");
        }

        // Lấy thông tin tài khoản và kiểm tra xem có tick chọn "Remember me" không
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Tiến hành xác thực
        if (Auth::attempt($credentials, $remember)) {
            // Đăng nhập đúng -> Xóa bộ đếm lỗi
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            // ---------- PHẦN CODE CẬP NHẬT ĐỂ PHÂN QUYỀN ----------
            $user = Auth::user(); // Lấy thông tin người dùng vừa login thành công

            // Nếu là admin -> Chuyển hướng thẳng vào trang quản lý User
            if ($user->role === 'admin') {
                return redirect('/admin/users');
            }

            // Nếu là user thường -> Đưa về trang Dashboard
            return redirect('/dashboard');
            // -------------------------------------------------------
        }

        // Đăng nhập sai -> Tăng bộ đếm lỗi lên 1. Mức phạt: khóa 60 giây nếu thử sai 5 lần.
        RateLimiter::hit($throttleKey, 60);

        return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
    }

    // 5. Hiển thị Dashboard
    public function dashboard()
    {
        return view('auth.dashboard');
    }

    // 6. Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}