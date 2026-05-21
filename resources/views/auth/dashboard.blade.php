<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Hệ thống Phân quyền</a>

            <div class="d-flex align-items-center text-white">
                <span class="me-3">Xin chào, <strong class="text-warning">{{ auth()->user()->name }}</strong>!</span>

                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 800px;">

        @if(auth()->user()->role === 'admin')
            <div class="card shadow border-0 border-start border-success border-5">
                <div class="card-body p-5 text-center">
                    <h2 class="text-success mb-3 fw-bold">Welcome Admin (Sếp)</h2>
                    <p class="text-muted mb-4 fs-5">Bạn có toàn quyền quản trị hệ thống. Hãy vào trang quản lý để thực hiện
                        các thao tác Thêm, Sửa, Xóa nhân viên.</p>
                    <a href="/admin/users" class="btn btn-success btn-lg px-5 shadow-sm">Vào trang Quản lý User</a>
                </div>
            </div>

        @else
            <div class="card shadow border-0 border-start border-info border-5">
                <div class="card-body p-5 text-center">
                    <h2 class="text-info mb-3 fw-bold">Welcome User (Nhân viên)</h2>
                    <p class="text-muted mb-4 fs-5">Chào mừng bạn quay lại hệ thống. Trang này dành riêng cho nhân viên và
                        bạn không có quyền truy cập vào khu vực Quản trị.</p>

                    <button class="btn btn-outline-info btn-lg px-5" disabled>Chức năng đang phát triển...</button>
                </div>
            </div>
        @endif

    </div>

</body>

</html>