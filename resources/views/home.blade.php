@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 space-y-16">
    <!-- Banner Section -->
    <div class="animate-slideIn">
    @if($banners->count() > 0)
    <div class="relative w-full h-96 overflow-hidden rounded-lg shadow-lg mb-8">
        @foreach($banners as $banner)
        <div class="absolute inset-0">
            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white">
                <h2 class="text-4xl font-bold mb-2">{{ $banner->title }}</h2>
                <p class="text-lg">{{ $banner->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Categories Section -->
    @if($mainCategories->count() > 0)
    <div class="animate-fadeIn" style="animation-delay: 0.2s">
        <h2 class="text-3xl font-bold mb-6">Danh mục sản phẩm</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($mainCategories as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="group">
                <div class="card hover-lift hover-glow">
                    @if($category->image_url)
                    <div class="relative w-full h-48">
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
                            <div class="w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-loading"></div>
                        </div>
                        <img src="{{ $category->image_url }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-48 object-cover img-hover absolute inset-0"
                             onload="this.parentElement.querySelector('.absolute').style.display='none'">
                    </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold group-hover:text-blue-600">{{ $category->name }}</h3>
                        @if($category->children->count() > 0)
                        <p class="text-sm text-gray-600 mt-1">{{ $category->children->count() }} danh mục con</p>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Best Sellers Section -->
    @if($bestSellers->count() > 0)
    <div class="animate-fadeIn" style="animation-delay: 0.4s">
        <h2 class="text-3xl font-bold mb-6">Sản phẩm bán chạy</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($bestSellers as $product)
            <div class="card hover-lift hover-glow">
                <a href="{{ route('product.show', $product->slug) }}">
                    @if($product->images->first())
                    <div class="relative w-full h-48">
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100">
                            <div class="w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-loading"></div>
                        </div>
                        <img src="{{ $product->images->first()->url }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover img-hover absolute inset-0"
                             onload="this.parentElement.querySelector('.absolute').style.display='none'">
                    </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-blue-600">{{ number_format($product->price) }}đ</span>
                            <span class="text-sm text-gray-500">Đã bán: {{ $product->sold_count }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Vouchers Section -->
    @if($vouchers->count() > 0)
    <div class="animate-fadeIn" style="animation-delay: 0.6s">
        <h2 class="text-3xl font-bold mb-6">Mã giảm giá</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vouchers as $voucher)
            <div class="card hover-lift p-6 border-2 border-dashed border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-blue-600 mb-2">{{ $voucher->code }}</h3>
                        <p class="text-gray-600">{{ $voucher->description }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-2xl font-bold text-red-600">
                            @if($voucher->type === 'percentage')
                                -{{ $voucher->value }}%
                            @else
                                -{{ number_format($voucher->value) }}đ
                            @endif
                        </span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        Hết hạn: {{ $voucher->expires_at ? $voucher->expires_at->format('d/m/Y') : 'N/A' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
