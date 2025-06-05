<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = User::with(['orders', 'reviews']);

            // Tìm kiếm theo tên hoặc email
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // Lọc theo vai trò
            if ($request->has('role')) {
                $query->where('role', $request->role);
            }

            // Sắp xếp
            $sort = $request->sort ?? 'created_at';
            $direction = $request->direction ?? 'desc';
            $query->orderBy($sort, $direction);

            // Thống kê
            $totalUsers = User::count();
            $totalAdmins = User::where('role', 'admin')->count();
            $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

            // Phân trang
            $users = $query->paginate(10);

            return view('admin.users.index', compact('users', 'totalUsers', 'totalAdmins', 'recentUsers'));
        } catch (\Exception $e) {
            \Log::error('Lỗi tại UserController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải danh sách người dùng');
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user'
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role']
            ]);

            return redirect()->route('admin.users.index')
                           ->with('success', 'Người dùng đã được tạo thành công');
        } catch (\Exception $e) {
            \Log::error('Lỗi tại UserController@store: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Có lỗi xảy ra khi tạo người dùng')
                           ->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'required|in:admin,user'
            ]);

            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role']
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $user->update($userData);

            return redirect()->route('admin.users.index')
                           ->with('success', 'Thông tin người dùng đã được cập nhật');
        } catch (\Exception $e) {
            \Log::error('Lỗi tại UserController@update: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Có lỗi xảy ra khi cập nhật thông tin người dùng')
                           ->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->id === auth()->id()) {
                return redirect()->back()->with('error', 'Không thể xóa tài khoản đang đăng nhập');
            }

            $user->delete();
            return redirect()->route('admin.users.index')
                           ->with('success', 'Người dùng đã được xóa thành công');
        } catch (\Exception $e) {
            \Log::error('Lỗi tại UserController@destroy: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Có lỗi xảy ra khi xóa người dùng');
        }
    }
}
