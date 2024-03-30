@php
    $user = session('user');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Học Bổng UTE</title>
    <link rel="shortcut icon" type="image/png" href="/image/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">



    <link rel="stylesheet" href="/css/Header-Footer.css">
</head>

<body>
    <!--header-->
    <div class="header">
        <nav class="header-title">
            <a href="{{ route('TrangChu_SV') }}"><img src="/image/favicon.png"></a>
            <a href="{{ route('TrangChu_SV') }}">Trang chủ</a>
            <a href="#">Tin tức</a>
            <a href="#">Liên hệ quản trị viên</a>
            <a href="{{ route('Phanhoi') }}">Phản hồi</a>
            <div class="dropdown show">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Chào bạn {{ $user->TenSV }}
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('DoiMatKhauSV') }}">Thay đổi mật khẩu</a>
                    <a class="dropdown-item" href="{{ route('ThongTinSV') }}">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="/logout">Đăng xuất</a>
                </div>
            </div>
        </nav>

    </div>

    {{-- Body here --}}
    @yield('body')

    <!--footer-->
    <footer>
        <div class="information">
            <p>Hệ thống Phần mềm Quản lý học bổng ; Copyright © 2023.</p>
            <p>Địa chỉ: số 48 Cao Thắng, TP. Đà Nẵng - Điện thoại: <a href="tel:+842363530590">(0236) 3530590</a> -
                Email: <a href="mailto:utemediaonline@gmail.com">utemediaonline@gmail.com</a></p>
            <p>Thiết kế bởi nhóm 24</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
