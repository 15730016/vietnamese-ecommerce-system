<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Bạn không có quyền truy cập trang quản trị.',
            ]);
        }

        return $next($request);
    }
}
