@php
    $user = session('user');
@endphp
@extends('sinhvien.layout.master')

@section('title', 'Thông tin sinh viên')

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
            margin-bottom: 0;
            padding-bottom: 100px;
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .information-SV {
            display: flex;
            width: 100%;
            justify-content: center;
            margin-top: 5%;
        }

        .row-sv {
            text-align: left;
            padding-left: 5%;
            padding-right: 5%;
        }

        .row-sv p {
            font-size: 20px;
            font-weight: bold;
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
            position: fixed;
            bottom: 0;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>THÔNG TIN SINH VIÊN</h1>
        </div>
        <div class="information-SV">
            <div class="row-sv">
                
                
                <p>Họ và tên: {{ $user->TenSV }}</p>
                <p>Giới tính: {{ $user->GioiTinh }}</p>
                <p>Lớp: {{ $lop->TenLop }}</p>
                <p>Địa chỉ: {{ $user->DiaChi }}</p>
                <p>Email: {{ $user->Email }}</p>
            </div>
            <div class="row-sv">
                <p>Mã sinh viên: {{ $user->MaSV }}</p>
                <p>Ngày sinh: {{ $user->NgaySinh }}</p>             
                <p>Khoa: {{ $khoa->TenKhoa }}</p>
                <p>Số điện thoại: {{ $user->SDT }}</p>
            </div>
        </div>
        <button><a href="{{route('SuaThongTinSV')}}">Cập Nhật</a></button>
        
    </div>
@endsection
