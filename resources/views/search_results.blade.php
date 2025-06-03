@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Kết quả tìm kiếm cho: "{{ $query }}"</h1>
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border rounded p-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4" />
                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-green-600 font-bold mb-2">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                    <a href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Xem chi tiết</a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p>Không tìm thấy sản phẩm nào phù hợp.</p>
    @endif
</div>
@endsection
