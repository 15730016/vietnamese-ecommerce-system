<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function resetPassword()
    {
        return view('admin.profile.reset-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('Mật khẩu hiện tại không đúng.');
                }
            }],
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Mật khẩu đã được cập nhật thành công.');
    }

    public function help()
    {
        return view('admin.profile.help');
    }
}
