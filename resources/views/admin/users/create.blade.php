@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Thêm người dùng</h1>

<form action="{{ route('admin.users.store') }}" method="POST" class="max-w-lg">
    @csrf
    <div class="mb-4">
        <label for="name" class="block font-medium mb-1">Tên</label>
        <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block font-medium mb-1">Email</label>
        <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}" required>
        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="role" class="block font-medium mb-1">Vai trò</label>
        <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
        </select>
        @error('role')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block font-medium mb-1">Mật khẩu</label>
        <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
        @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block font-medium mb-1">Xác nhận mật khẩu</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tạo người dùng</button>
</form>
@endsection
