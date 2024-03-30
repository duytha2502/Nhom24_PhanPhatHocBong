@extends('ctsv.layout.master')

@section('title', 'Chi tiết phản hồi')

@section('body')
    <style>
        body {
            background-color: #F1F1F1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
        }

        .container-fluid {
            flex-grow: 1;
            margin-top: 100px;
            margin-bottom: 20px;
            border: 1px solid #001E3C;
            padding: 20px;

        }

        .container-fluid h3 {
            color: #C31313;
        }


        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 0.5em;
        }

        th {
            text-align: center;
        }

        .logo {
            height: 50px;
            width: 50px;
        }

        .custom-container {
            max-width: 960px;
            /* change this value to adjust the width as needed */
        }

        /* image css */
        .table-image {
            height: 150px;
            object-fit: contain;
        }

        .button-container {
            display: flex;
            margin-bottom: 20px;
            justify-content: center;
        }

        button {
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: 30px;
            margin-right: 30px;
            cursor: pointer;
            border-radius: 4px;
        }

        .agree {
            background-color: #003C71;
            width: 120px;
        }
        .agree,.cancel a{
            text-decoration: none;
        }

        .cancel {
            background-color: rgb(175, 175, 63);
            width: 120px;
        }

        .agree:hover {
            background-color: #3e8e41;
            color: #001E3C;
        }

        .cancel:hover {
            color: #001E3C;
            background-color: #C31313;
        }
        .submit{
            color: white;
            background-color: #C31313;
        }
    </style>
    <div class="container-fluid custom-container">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Mã sinh viên</td>
                    <td>{{$ctPH->MaSV}}</td>
                </tr>
                <tr>
                    <td>Họ và tên</td>
                    <td>{{$ctPH->TenSV}}</td>
                </tr>
                <tr>
                    <td>Ngày phản hồi</td>
                    <td>{{$ctPH->ThoiGian}}</td>
                </tr>
                <tr>
                    <td>Nội dung</td>
                    <td>{{$ctPH->NoiDung}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
