<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm Người Dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">
    <div class="container" style="max-width: 600px;">
        <h2 class="mb-4">Tạo Người Dùng Mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/users" method="POST">
            @csrf <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu (Tối thiểu 6 ký tự)</label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>

            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select">
                    <option value="user">User Thường</option>
                    <option value="admin">Admin (Quản trị)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Lưu Người Dùng</button>
            <a href="/admin/users" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>