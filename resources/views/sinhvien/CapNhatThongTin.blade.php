@php
    $user = session('user');
@endphp
@extends('sinhvien.layout.master')

@section('title', 'Cập nhật thông tin')

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
            margin-bottom: 100px;
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .form-update {
            margin-top: 30px;
            height: 600px;
            width: 400px;
            background: #21C3E0;
            border: 1px solid black;
            border-radius: 5px;
            display: inline-block;
        }

        .text-input {
            height: 70px;
        }

        .text-input input,
        select {
            padding: 5px;
            float: right;
            margin-right: 8%;
            width: 50%;
            margin-top: 20px;
        }

        .text-input label {
            margin-top: 30px;
            float: left;
            margin-left: 5%;
            font-weight: bold;
        }

        form button.btn {
            border: 1px solid black;
            border-radius: 5px;
            margin-top: 10% !important;
            cursor: pointer;
        }

        form button a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .text-danger {
            text-align: left;
            margin-left: 40%;
            color: red;
        }

        .select-gt {
            margin-left: 13%;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>CẬP NHẬT THÔNG TIN CÁ NHÂN</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-error">
                    {{ session('fail') }}
                </div>
            @endif
        </div>
        <div class="form-update">
            <form action="{{ route('CapNhatThongTinSVController') }}" method="post">
                @csrf
                @method('PUT')
                <div class="text-input">
                    <label for="TenSV">Tên sinh viên</label>
                    <input type="text" name="TenSV" value="{{ $data->TenSV }}" id="TenSV"
                        placeholder="Nhập tên sinh viên: ">
                    @if ($errors->any('TenSV'))
                        <p class="text-danger">{{ $errors->first('TenSV') }}</p>
                    @endif
                </div>
                <div class="text-input">
                    <label for="GioiTinh">Giới tính</label>
                    <select name="GioiTinh" class="select-gt">
                        <option value="Nam" {{ $data->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $data->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
                <div class="text-input">
                    <label>Ngày sinh</label>
                    <input name="NgaySinh" type="date" value="{{ $data->NgaySinh }}" max="<?php
                    $eighteenYearsAgo = date('Y-m-d', strtotime('-18 years'));
                    echo $eighteenYearsAgo; ?>">
                </div>
                <div class="text-input">
                    <label for="DiaChi">Địa chỉ</label>
                    <input type="text" name="DiaChi" value="{{ $data->DiaChi }}" id="DiaChi"
                        placeholder="Nhập địa chỉ: ">
                    @if ($errors->any('DiaChi'))
                        <p class="text-danger">{{ $errors->first('DiaChi') }}</p>
                    @endif
                </div>
                <div class="text-input">
                    <label for="SDT">Số điện thoại</label>
                    <input type="text" name="SDT" value="{{ $data->SDT }}" id="SDT"
                        placeholder="Nhập số điện thoại: ">
                    @if ($errors->any('SDT'))
                        <p class="text-danger">{{ $errors->first('SDT') }}</p>
                    @endif
                </div>
                <div class="text-input">
                    <label for="Email">Email</label>
                    <input type="text" name="Email" value="{{ $data->Email }}" id="Email"
                        placeholder="Nhập email: ">
                    @if ($errors->any('Email'))
                        <p class="text-danger">{{ $errors->first('Email') }}</p>
                    @endif
                </div>
                <button class="btn btn-success m-1" type="submit" name="submit">Cập Nhật</button>
            </form>
        </div>
    </div>
@endsection
