<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/Logo.png" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: url('https://images.unsplash.com/photo-1549237515-e7d9ae62f657') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            width: 400px;
            text-align: center;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.7);
        }
        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .login-btn {
            background-color: #f5a623;
            border: none;
            width: 100%;
            color: white;
            font-weight: bold;
            margin: 15px 0;
        }
        .social-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body style="background-image: url(../img/bg.webp); width: 100%;">
    <div class="login-form ">
        <div class="login-title">Đăng nhập trang quản trị</div>
        <p>Have an account?</p>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('login.submit') }}" method="POST" >
        @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>

                <!-- Hiển thị lỗi nếu có -->
            @error('username')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
            </div>
            
            
            <div class="mb-3 position-relative">
                <input id="password-field" name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                <a class="btn position-absolute top-50 end-0 translate-middle-y" onclick="togglePasswordVisibility()">
                    <i class="bi bi-eye-slash" id="eye-icon"></i>
                </a>
            </div>
            <button type="submit" class="btn login-btn">Đăng nhập</button>
            <div class="d-flex justify-content-between">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe" name="rememberMe">Ghi nhớ mật khẩu</label>
                </div>
                <a href="#">Quên mật khẩu</a>
            </div>
            <hr>
            <!-- <p>Đăng nhập bằng tài khoảng khác</p>
            <div class="d-flex justify-content-around social-btn">
                <button class="btn btn-outline-primary">Google</button> -->
               
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function togglePasswordVisibility() {
    const passwordField = document.getElementById('password-field');
    const eyeIcon = document.getElementById('eye-icon');

    // Kiểm tra và thay đổi loại của ô mật khẩu
    if (passwordField.type === "password") {
      passwordField.type = "text"; // Hiển thị mật khẩu
      eyeIcon.classList.replace('bi-eye-slash', 'bi-eye'); // Chuyển icon thành bi-eye
    } else {
      passwordField.type = "password"; // Ẩn mật khẩu
      eyeIcon.classList.replace('bi-eye', 'bi-eye-slash'); // Chuyển icon thành bi-eye-slash
    }
  }
</script>
</body>
</html>
