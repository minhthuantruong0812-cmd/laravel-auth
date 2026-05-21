<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 1. Hiển thị danh sách User (Read)
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // 2. Hiển thị form tạo mới (Create)
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Lưu User mới vào Database (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công!');
    }

    // 4. Hiển thị form chỉnh sửa (Edit)
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 5. Cập nhật thông tin (Update)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Nếu có nhập mật khẩu mới thì mới cập nhật
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    // 6. Xóa người dùng (Destroy)
    public function destroy(User $user)
    {
        // Bonus: Không cho phép Admin tự xóa chính mình
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Cảnh báo: Bạn không thể tự xóa tài khoản của chính mình!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Đã xóa người dùng thành công!');
    }
}