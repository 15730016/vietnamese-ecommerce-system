@extends('layouts.admin')

@section('title', 'Quản Lý Người Dùng')

@section('content')
<div>
    <!-- Tiêu đề trang -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Quản Lý Người Dùng</h1>
        <p class="mt-2 text-sm text-gray-700">Quản lý tất cả tài khoản người dùng trong hệ thống</p>
    </div>

    <!-- Thông báo -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Thanh công cụ -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <!-- Tìm kiếm và lọc -->
        <div class="w-full md:w-2/3 flex flex-col sm:flex-row gap-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex-1">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Tìm kiếm theo tên hoặc email..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </form>
            <select name="role" 
                    onchange="this.form.submit()" 
                    class="w-full sm:w-48 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <option value="">Tất cả vai trò</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Người dùng</option>
            </select>
        </div>

        <!-- Nút thêm mới -->
        <div class="w-full md:w-auto">
            <a href="{{ route('admin.users.create') }}" 
               class="w-full md:w-auto flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Thêm Người Dùng
            </a>
        </div>
    </div>

    <!-- Bảng danh sách -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tên
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vai Trò
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ngày Tạo
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao Tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-xl font-medium text-gray-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                            {{ $user->role === 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="text-indigo-600 hover:text-indigo-900">
                                Sửa
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    Xóa
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        Không tìm thấy người dùng nào
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
