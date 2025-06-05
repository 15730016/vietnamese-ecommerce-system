<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Xử lý yêu cầu đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            if ($request->ajax()) {
                return response()->json(['error' => 'Không có quyền truy cập'], 403);
            }
            return redirect()->route('admin.login')->with('error', 'Bạn cần đăng nhập với tài khoản quản trị để truy cập trang này');
        }

        return $next($request);
    }
}
