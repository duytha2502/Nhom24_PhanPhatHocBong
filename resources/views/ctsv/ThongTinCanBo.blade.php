@php
    $ctsv = session('ctsv');
@endphp

@extends('ctsv.layout.master')

@section('title', 'Thông tin cán bộ')

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
            margin-bottom: 50px;
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

        /* .container button a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        } */
        .form-update {
            margin-top: 30px;
            padding-top: 20px;
            height: 400px;
            width: 550px;
            justify-items: center;
            background: #ffffff;
            border: 1px solid rgb(37, 44, 255);
            border-radius: 5px;
            display: inline-block;
        }
        .update-btn{
            background-color: red;
            color: white;
            width: 150px;
            margin: 0 auto;
            border-radius: 5px;
            border: 1px solid black;
            font-size: 13pt;
            padding: 10px;
            margin-top: 6%;
            display: block;
        }
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>THÔNG TIN CÁN BỘ</h1>
        </div>
        <form class="form-update" action="{{route('ThongTinCanBo')}}" method="post">
        @csrf    
        <div>
            <div class="row-sv">
                <p>Họ và tên: {{$data->HoTen}}</p>
                <p>Giới tính: {{$data->GioiTinh}}</p>
                <p>Quê quán: {{$data->DiaChi}}</p>
                <p>Email: {{$data->Email}}</p>
            </div>
            <div class="row-sv">
                <p>Mã cán bộ: {{$data->MaCanBo}}</p>
                <p>Số điện thoại: {{$data->SDT}}</p>
            </div>
        </div>
        <a class="update-btn" href="{{route('SuaThongTin')}}">Cập Nhật</a>
        </form>
    </div>

@endsection
