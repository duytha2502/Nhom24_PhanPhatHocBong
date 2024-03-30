<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập | Học Bổng UTE</title>
    <link rel="shortcut icon" type="image/png" href="/image/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/DangNhap.css">
</head>

<body>
    <!--header-->
    <div class="header">
        <nav>
            <a href="/"><img src="/image/favicon.png"></a>
            <a href="/">Trang chủ</a>
            <a href="#">Hướng dẫn sử dụng hệ thống</a>
            <a href="#">Liên hệ quản trị viên</a>
            <a href="#">Trợ giúp</a>
        </nav>
    </div>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>ĐĂNG NHẬP HỆ THỐNG</h1>
        </div>
        <div><span class="text-danger" style="color: rgb(25, 25, 25); font-size: 24pt; background-color: rgb(255, 58, 58); ">@error('fail') {{ $message }} @enderror</span> </div>
        <div class="form-login">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="text-input">
                    <label>Mã đăng nhập</label>
                    <input type="text" name="username" placeholder="Mã Cán Bộ or MSV" required title="Vui lòng nhập tên đăng nhập">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="text-input">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Mật Khẩu" required title="Vui lòng nhập mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit">Đăng Nhập</button>
                    </div>
                    <!-- /.col -->
                </div>
                @csrf
            </form>
        </div>

    </div>
     <!--footer-->
     <footer>
        <div class="information">
            <p>Hệ thống Phần mềm Quản lý học bổng ; Copyright © 2023.</p>
            <p>Địa chỉ: số 48 Cao Thắng, TP. Đà Nẵng - Điện thoại: <a href="tel:+842363530590">(0236) 3530590</a> -
                Email: <a href="mailto:utemediaonline@gmail.com">utemediaonline@gmail.com</a></p>
            <p>Thiết kế bởi nhóm 24</p>
        </div>
    </footer>

</body>

</html>

