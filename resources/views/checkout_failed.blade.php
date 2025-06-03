@extends('layouts.app')

@section('title', 'Thanh toán thất bại')

@section('content')
<div class="text-center py-10">
    <h1 class="text-3xl font-bold text-red-600 mb-4">Thanh toán thất bại</h1>
    <p class="text-lg text-gray-700">Rất tiếc, quá trình thanh toán không thành công. Vui lòng thử lại.</p>
    <a href="{{ route('cart.index') }}" class="mt-6 inline-block bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Quay lại giỏ hàng</a>
</div>
@endsection
