<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chỉnh sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5 bg-light">
    <div class="container bg-white p-4 shadow-sm" style="max-width: 600px; border-radius: 10px;">
        <h2 class="mb-4 text-primary">Chỉnh sửa người dùng</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label">Tên người dùng</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu mới (Để trống nếu không muốn đổi)</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập pass mới hoặc bỏ trống">
            </div>

            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User thường</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">Cập nhật</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</body>

</html>