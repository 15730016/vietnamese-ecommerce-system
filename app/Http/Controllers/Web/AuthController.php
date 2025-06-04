<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'nullable|string|email',
            'password' => 'nullable|string',
            'phone' => 'nullable|string',
            'otp' => 'nullable|string',
            'provider' => 'nullable|string|in:google,facebook',
            'provider_token' => 'nullable|string',
        ]);

        if ($request->provider && $request->provider_token) {
            // Social login
            $user = User::where('provider', $request->provider)
                ->where('provider_id', $request->provider_token)
                ->first();

            if (!$user) {
                return redirect()->back()->withErrors(['login' => 'Invalid social login credentials']);
            }
        } elseif ($request->phone) {
            // Phone login with OTP, no password required
            // Here you should verify OTP with Zalo or SMS service (not implemented here)
            // For now, assume OTP is valid if provided

            if (!$request->otp) {
                return redirect()->back()->withErrors(['otp' => 'OTP is required for phone login']);
            }

            $user = User::firstOrCreate(
                ['phone' => $request->phone],
                ['name' => 'User ' . $request->phone, 'password' => bcrypt(str_random(8))]
            );
        } elseif ($request->email) {
            // Email login
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return redirect()->back()->withErrors(['login' => 'Invalid email or password']);
            }
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid login credentials']);
        }

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
