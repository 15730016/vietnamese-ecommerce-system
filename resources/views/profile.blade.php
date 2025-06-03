@extends('layouts.app')

@section('title', 'Trang cá nhân')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Thông tin cá nhân</h1>
    <div class="bg-white p-6 rounded shadow">
        <p><strong>Họ tên:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Số điện thoại:</strong> {{ auth()->user()->phone ?? 'Chưa cập nhật' }}</p>
        <p><strong>Địa chỉ:</strong> {{ auth()->user()->address ?? 'Chưa cập nhật' }}</p>
    </div>
</div>
@endsection
