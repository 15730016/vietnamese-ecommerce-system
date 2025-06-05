@extends('layouts.admin-layout')

@section('title', 'Hồ Sơ Quản Trị')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Thông Tin Cá Nhân</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Họ và tên</label>
                    <p class="mt-1 text-lg text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-lg text-gray-900">{{ auth()->user()->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Vai trò</label>
                    <p class="mt-1 text-lg text-gray-900">Quản trị viên</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ngày tham gia</label>
                    <p class="mt-1 text-lg text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Đăng nhập lần cuối</label>
                    <p class="mt-1 text-lg text-gray-900">{{ auth()->user()->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center space-x-4">
            <a href="{{ route('admin.password.reset') }}" class="btn btn-primary">
                Đổi Mật Khẩu
            </a>
        </div>
    </div>
</div>
@endsection
