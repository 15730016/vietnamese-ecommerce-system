@extends('layouts.admin-layout')

@section('title', 'Đổi Mật Khẩu')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6 max-w-lg mx-auto">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Đổi Mật Khẩu</h2>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">
                    Mật khẩu hiện tại
                </label>
                <input type="password" 
                       name="current_password" 
                       id="current_password" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mật khẩu mới
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Xác nhận mật khẩu mới
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.profile') }}" class="text-gray-600 hover:text-gray-900">
                    Hủy
                </a>
                <button type="submit" class="btn btn-primary">
                    Cập Nhật Mật Khẩu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
