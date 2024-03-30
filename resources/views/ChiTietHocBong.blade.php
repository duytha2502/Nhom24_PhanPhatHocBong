@php
    if (session('user')) {
        $user = session('user');
        $layout = 'sinhvien.layout.master';
    } elseif (session('ctsv')) {
        $ctsv = session('ctsv');
        $layout = 'ctsv.layout.master';
    }

@endphp
@extends($layout)

@section('title', 'Chi tiết học bổng')

@section('body')
    <style>
        /*container*/
        .container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .title img {
            width: 100%;
            height: 400px;
            background-size: cover;
        }

        .information-SV {
            display: flex;
            width: 100%;
            justify-content: center;
            gap: 50px;
        }

        .row {
            width: 45%;
            text-align: left;
        }

        .row p {
            font-size: 20px;
            font-weight: bold;
            line-height: 25px;
        }

        .container button {
            background: #EF0909;
            height: 50px;
            width: 150px;
            border: 1px solid black;
            cursor: pointer;
            margin-top: 30px;
        }

        .container button a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
        footer {
            margin-top: 3%; 
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>{{$hocbong->TenHocBong}} </h1>
            <img src="{{$hocbong->Anh}}">
        </div>
        <div class="information-SV">
            <div class="row">
                <p>Số lượng tham gia: {{$hocbong->SoLuongThamGia}}</p>
                <p>Hạn: {{$hocbong->NgayBatDau}} đến {{$hocbong->NgayKetThuc}}</p>
                <p>
                    Tiêu chí: {{$hocbong->TieuChi}}
                </p>
                <p>Đối tượng: {{$hocbong->DoiTuong}}</p>
                <p>Nhà tài trợ: {{$hocbong->NhaTaiTro}}</p>
            </div>
            <div class="row">
                <p>Thông tin học bổng: {{$hocbong->MoTa}}
                </p>
            </div>      
        </div>
        @if (session('user'))
            <button class="signUp"><a href="{{ route("ShowDangKyHB", $hocbong->MaHB) }}">Đăng Ký</a></button>
        @elseif(session('ctsv'))
            <button class="signUp"><a onclick="return confirm('Bạn có chắc chắn muốn gỡ bài?')" href="{{url('/delete').'/'.$hocbong->MaHB}}">Gỡ bài</a></button>
        @endif  
    </div>
@endsection
