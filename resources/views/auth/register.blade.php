<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký</title>
</head>

<body>
    <h2>Đăng ký tài khoản</h2>

    <form method="POST" action="{{ url('/register') }}">
        @csrf <div>
            <label>Họ và tên:</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Mật khẩu:</label>
            <input type="password" name="password">
            @error('password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation">
        </div>
        <br>

        <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ url('/login') }}">Đăng nhập ngay</a></p>
</body>

</html>