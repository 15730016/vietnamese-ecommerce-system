@extends('layouts.admin')

@section('title', 'Quản Lý Banner')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Quản Lý Banner</h1>
        <a href="{{ route('admin.banners.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Thêm Banner Mới</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Tiêu Đề</th>
                    <th class="p-2">Hình Ảnh</th>
                    <th class="p-2">Đường Dẫn</th>
                    <th class="p-2">Vị Trí</th>
                    <th class="p-2">Trạng Thái</th>
                    <th class="p-2">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $banner->id }}</td>
                    <td class="p-2">{{ $banner->title }}</td>
                    <td class="p-2">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="w-16 h-auto">
                    </td>
                    <td class="p-2">{{ $banner->link }}</td>
                    <td class="p-2">{{ $banner->position }}</td>
                    <td class="p-2">{{ $banner->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="text-blue-600 hover:underline">Sửa</a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:underline" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $banners->links() }}
    </div>
</div>
@endsection
