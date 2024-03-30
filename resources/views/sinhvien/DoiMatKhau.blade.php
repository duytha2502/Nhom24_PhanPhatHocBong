@extends('sinhvien.layout.master')

@section('title', 'Đổi mật khẩu')

@section('body')
    <style>
        /*container*/
        .container {
            width: 100%;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 100px;
            flex-direction: column;
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .form-update {
            margin-top: 30px;
            height: 350px;
            width: 400px;
            background: #21C3E0;
            border: 1px solid black;
            border-radius: 5px;
            padding: 5px;
        }

        .text-input-ctv {
            height: 50px;
        }

        .text-input-ctv input {
            float: right;
            margin-right: 4%;
            width: 160px;
            padding: 5px;
            margin-top: -2%;
        }


        .text-input-ctv label {
            font-weight: bold;
        }

        .text-input-ctv {
            margin-top: 30px;
        }

        form button.btn {
            background: #0ee939;
            margin-top: 20px;
        }

        form button a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .error-text {
            color: red;
            margin-left: 46%;
            float: left;
        }

        /*footer*/
        footer {
            background-color: #003C71;
            padding: 10px;
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            justify-content: center;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>ĐỔI MẬT KHẨU</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div><span class="text-danger">
                @error('fail')
                    {{ $message }}
                @enderror
            </span> </div>
        <div class="form-update">
            <form action="{{ route('CapNhatMatKhauSV') }}" method="post">
                @csrf
                <div class="text-input-ctv">
                    <label for="matKhauCu">Mật khẩu cũ</label>
                    <input name="matKhauCu" type="password" id="matKhauCu">
                    @if ($errors->has('matKhauCu'))
                        <p class="error-text">{{ $errors->first('matKhauCu') }}</p>
                    @endif
                </div>
                <div class="text-input-ctv">
                    <label for="matKhauMoi">Mật khẩu mới</label>
                    <input name="matKhauMoi" type="password" id="matKhauMoi">
                    @if ($errors->has('matKhauMoi'))
                        <p class="error-text">{{ $errors->first('matKhauMoi') }}</p>
                    @endif
                </div>
                <div class="text-input-ctv">
                    <label for="xacNhanMatKhau">Nhập lại mật khẩu</label>
                    <input name="xacNhanMatKhau" type="password" id="xacNhanMatKhau">
                    @if ($errors->has('xacNhanMatKhau'))
                        <p class="error-text">{{ $errors->first('xacNhanMatKhau') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection
