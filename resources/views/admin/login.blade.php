@extends('layouts.app')

@section('title', 'Đăng nhập quản trị viên')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-yellow-300 to-yellow-400">
    <div class="max-w-md w-full p-6 bg-white rounded shadow">
        <div class="flex justify-center mb-6">
            <img src="/images/logo.png" alt="Nobinobi Logo" class="h-20" />
        </div>
        <h1 class="text-3xl font-bold mb-4 text-center text-orange-500">Đăng nhập</h1>
        <p class="text-center text-gray-600 mb-6">Vui lòng đăng nhập để hưởng những đặc quyền dành cho thành viên.</p>
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <input type="text" name="phone" placeholder="Nhập số điện thoại" class="w-full border border-gray-300 rounded py-2 px-4 mb-4 focus:outline-none focus:ring-2 focus:ring-orange-400" />
            <button type="submit" class="w-full bg-orange-400 text-white py-2 rounded hover:bg-orange-500 transition">Đăng nhập</button>
            <div class="mt-4 text-sm text-gray-600">
                <input type="checkbox" id="terms" name="terms" class="mr-2" />
                <label for="terms">Tôi đã đọc và đồng ý với <a href="#" class="text-blue-600 underline">Điều Khoản Chung</a> &amp; <a href="#" class="text-blue-600 underline">Chính Sách Bảo Mật</a> của nobinobi.</label>
            </div>
        </form>
    </div>
</div>
@endsection
