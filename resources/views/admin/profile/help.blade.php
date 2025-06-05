@extends('layouts.admin-layout')

@section('title', 'Trợ Giúp')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Trợ Giúp & Hướng Dẫn</h2>

        <div class="space-y-8">
            <!-- Quản lý sản phẩm -->
            <div class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900">Quản lý sản phẩm</h3>
                <div class="pl-4 space-y-2">
                    <p class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        Thêm sản phẩm mới: Truy cập menu "Sản phẩm" và nhấn nút "Thêm sản phẩm"
                    </p>
                    <p class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        Cập nhật thông tin: Nhấn vào nút "Sửa" bên cạnh sản phẩm cần chỉnh sửa
                    </p>
                </div>
            </div>

            <!-- Quản lý đơn hàng -->
            <div class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900">Quản lý đơn hàng</h3>
                <div class="pl-4 space-y-2">
                    <p class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        Xem chi tiết đơn hàng: Nhấn vào mã đơn hàng để xem thông tin chi tiết
                    </p>
                    <p class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        Cập nhật trạng thái: Sử dụng menu dropdown để thay đổi trạng thái đơn hàng
                    </p>
                </div>
            </div>

            <!-- Liên hệ hỗ trợ -->
            <div class="space-y-4">
                <h3 class="text-xl font-medium text-gray-900">Liên hệ hỗ trợ</h3>
                <div class="pl-4 space-y-4">
                    <p class="text-gray-600">
                        Nếu bạn cần hỗ trợ thêm, vui lòng liên hệ:
                    </p>
                    <div class="space-y-2">
                        <p class="text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            Hotline: 1900 xxxx
                        </p>
                        <p class="text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Email: support@haxuvina.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
