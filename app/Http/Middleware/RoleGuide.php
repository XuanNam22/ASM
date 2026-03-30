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
        // Hướng dẫn viên thì được qua
        if (Auth::check() && Auth::user()->role === 'guide') {
            return $next($request);
        }
        
        return redirect('/login')->with('error', 'Bạn không có quyền truy cập khu vực này!');
    }
}