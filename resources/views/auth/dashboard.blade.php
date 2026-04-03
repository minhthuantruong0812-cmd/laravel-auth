<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h2>Chào mừng đến với Dashboard!</h2>

    <p><strong>Tên của bạn:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

    <hr>

    <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</body>

</html>