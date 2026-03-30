<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Nếu đã đăng nhập và là admin thì cho đi tiếp
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        // Nếu không phải, đuổi về trang chủ hoặc trang lỗi (ở đây tạm đuổi về trang login)
        return redirect('/login')->with('error', 'Bạn không có quyền truy cập khu vực này!');
    }
}