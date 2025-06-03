@extends('layouts.app')

@section('title', 'Thanh toán thành công')

@section('content')
<div class="text-center py-10">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Thanh toán thành công</h1>
    <p class="text-lg text-gray-700">Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đã được xử lý.</p>
    <a href="{{ route('home') }}" class="mt-6 inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Quay về trang chủ</a>
</div>
@endsection
