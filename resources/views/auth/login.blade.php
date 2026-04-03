<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng nhập</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

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
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Ghi nhớ đăng nhập</label>
        </div>
        <br>

        <button type="submit">Đăng nhập</button>
    </form>

    <p>Chưa có tài khoản? <a href="{{ url('/register') }}">Đăng ký ngay</a></p>
</body>

</html>