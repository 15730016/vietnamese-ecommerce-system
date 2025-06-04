<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

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
                return response()->json(['error' => 'Invalid social login credentials'], 401);
            }
        } elseif ($request->phone) {
            // Phone login with OTP, no password required
            // Here you should verify OTP with Zalo or SMS service (not implemented here)
            // For now, assume OTP is valid if provided

            if (!$request->otp) {
                return response()->json(['error' => 'OTP is required for phone login'], 401);
            }

            $user = User::firstOrCreate(
                ['phone' => $request->phone],
                ['name' => 'User ' . $request->phone, 'password' => bcrypt(str_random(8))]
            );
        } elseif ($request->email) {
            // Email login
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Invalid email or password'], 401);
            }
        } else {
            return response()->json(['error' => 'Invalid login credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
