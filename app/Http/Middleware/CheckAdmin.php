<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Thêm thư viện Auth để kiểm tra người dùng

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra: Nếu người dùng đã đăng nhập VÀ có role = 1 (Admin) thì cho phép đi tiếp
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Nếu chưa đăng nhập hoặc không phải admin thì đẩy về trang dashboard và báo lỗi
        return redirect('/dashboard')->with('error', 'Bạn không có quyền truy cập khu vực Quản trị!');
    }
}