<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleGuide
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Chưa đăng nhập thì bắt đi đăng nhập
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Nếu đúng là Guide thì cho qua
        if (Auth::user()->role === 'guide') {
            return $next($request);
        }

        // 3. Đã đăng nhập nhưng sai quyền (ví dụ Admin đi lạc vào đây) thì báo lỗi 403
        abort(403, 'Bạn không có quyền truy cập khu vực của Hướng dẫn viên!');
    }
}
