@extends('layouts.app')

@section('title', 'Đăng nhập quản trị')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background_login_desktop.svg') }}');">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-8">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/logo-haxu-all-12.png') }}" alt="Logo" class="h-16 w-auto">
        </div>
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Đăng nhập trang quản trị</h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block mb-2 font-semibold text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus autocomplete="email"
                        class="form-input" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="block mb-2 font-semibold text-gray-700">Mật khẩu</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="form-input">
                </div>

                <button type="submit" class="btn-primary">
                    Đăng nhập
                </button>
            </form>
    </div>
</div>
@endsection
