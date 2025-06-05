@extends('layouts.admin')

@section('title', 'Thêm Người Dùng Mới')

@section('content')
<div>
    <!-- Tiêu đề trang -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Thêm Người Dùng Mới</h1>
        <p class="mt-2 text-sm text-gray-700">Tạo tài khoản người dùng mới trong hệ thống</p>
    </div>

    <!-- Thông báo lỗi -->
    @if($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form thêm mới -->
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Tên người dùng -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Tên người dùng <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       placeholder="Nhập tên người dùng">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}"
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       placeholder="example@domain.com">
            </div>

            <!-- Mật khẩu -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mật khẩu <span class="text-red-500">*</span>
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       placeholder="Nhập mật khẩu">
                <p class="mt-1 text-sm text-gray-500">
                    Mật khẩu phải có ít nhất 8 ký tự
                </p>
            </div>

            <!-- Vai trò -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">
                    Vai trò <span class="text-red-500">*</span>
                </label>
                <select name="role" 
                        id="role" 
                        required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Chọn vai trò</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Người dùng</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                </select>
            </div>

            <!-- Nút submit -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Hủy bỏ
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Thêm người dùng
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
