<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light p-5">

    <div class="container bg-white p-4 shadow-sm" style="border-radius: 15px;">
        <div class="mb-4">

    <a href="/admin/users"
       class="btn btn-dark">
        Users
    </a>

    <a href="/admin/categories"
       class="btn btn-dark">
        Categories
    </a>

    <a href="/admin/products"
       class="btn btn-dark">
        Products
    </a>

    <a href="/admin/orders"
       class="btn btn-dark">
        Orders
    </a>

    <a href="/products"
       class="btn btn-primary">
        Shop
    </a>

    <form action="/logout"
          method="POST"
          class="d-inline">

        @csrf

        <button type="submit"
                class="btn btn-danger">

            Logout

        </button>

    </form>

</div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-users-cog me-2"></i>Danh sách người dùng</h2>
            <div>
                <a href="/dashboard" class="btn btn-outline-secondary me-2">Quay lại Dashboard</a>
                <a href="{{ route('users.create') }}" class="btn btn-success px-4">
                    <i class="fas fa-user-plus me-1"></i> Tạo User Mới
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-hover align-middle border">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th class="text-center">Vai trò (Role)</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="ps-3 fw-bold">#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->role === 'admin')
                                <span class="badge bg-danger rounded-pill px-3">Admin</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3">User</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i> Sửa
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('⚠️ CẢNH BÁO: Bạn có chắc chắn muốn xóa người dùng [{{ $user->name }}] không? Hành động này không thể hoàn tác!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($users->isEmpty())
            <div class="text-center py-5 text-muted">
                <p>Chưa có dữ liệu người dùng nào.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>