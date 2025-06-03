@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Giỏ hàng của bạn</h1>
    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Sản phẩm</th>
                    <th class="p-3 text-center">Số lượng</th>
                    <th class="p-3 text-right">Giá</th>
                    <th class="p-3 text-right">Tổng</th>
                    <th class="p-3 text-center">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $productId => $item)
                <tr class="border-t border-gray-300">
                    <td class="p-3">{{ $item['name'] }}</td>
                    <td class="p-3 text-center">{{ $item['quantity'] }}</td>
                    <td class="p-3 text-right">{{ number_format($item['price'], 0, ',', '.') }}₫</td>
                    <td class="p-3 text-right">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</td>
                    <td class="p-3 text-center">
                        <form action="{{ route('cart.remove', $productId) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 text-right">
            <a href="{{ route('checkout') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Thanh toán</a>
        </div>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
@endsection
