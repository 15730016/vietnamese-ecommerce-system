@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Đăng nhập</h2>
        @if(session('error'))
            <div class="mb-4 text-red-600 text-center">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Mật khẩu</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-3 py-2 border rounded">
            </div>
            <div class="flex items-center justify-between mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    <span class="ml-2 text-gray-700">Ghi nhớ đăng nhập</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition">Đăng nhập</button>
        </form>
    </div>
</div>
@endsection
