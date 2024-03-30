@extends('ctsv.layout.master')

@section('title', 'Chi tiết duyệt')

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
            color: white ;
            background-color: #C31313;
        }
    </style>
    <div class="container-fluid custom-container">
        <h3>{{$ctPD->TenHocBong}}</h3>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Họ và tên</td>
                    <td>{{$ctPD->TenSV}}</td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>{{$ctPD->GioiTinh}}</td>
                </tr>
                <tr>
                    <td>Lớp</td>
                    <td>{{$ctPD->TenLop}}</td>
                </tr>
                <tr>
                    <td>Quê quán</td>
                    <td>{{$ctPD->DiaChi}}</td>
                </tr>
                <tr>
                    <td>Mã sinh viên</td>
                    <td>{{$ctPD->MaSV}}</td>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <td>{{$ctPD->NgaySinh}}</td>
                </tr>
                <tr>
                    <td>Khoa</td>
                    <td>{{$ctPD->TenKhoa}}</td>
                </tr>
                <tr>
                    <td>Ngày đăng ký</td>
                    <td>{{$ctPD->NgayDangKy}}</td>
                </tr>
                @foreach($Anh as $index => $item)
                <tr>
                    <td>Minh chứng {{$index + 1}}</td>
                    <td>
                        <img src="{{$item->AnhMinhChung}}" alt="Image 1" class="img-fluid table-image" data-toggle="modal"
                            data-target="#imageModal1">
                        <!-- Modal -->
                        <div class="modal fade" id="imageModal1" tabindex="-1" role="dialog"
                            aria-labelledby="imageModal1Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModal1Label">Minh chứng {{$index + 1}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{$item->AnhMinhChung}}" alt="Image 1" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </table>

        </div>
    </div>

    <div class="button-container">
        <button class="agree">
            <a href="" style="color: white" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#modalLoginForm">
                Duyệt
            </a>
        </button>

        <button class="cancel">
            <a style="color: white;" href="{{url('/update').'/'.$ctPD->MaPhieu}}">Hủy Duyệt</a>
        </button>
    </div>
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{url('/add').'/'.$ctPD->MaPhieu}}">
                    @csrf
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Chấm điểm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Điểm</label>
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="text" name="Diem" id="defaultForm-email" class="form-control validate">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-default submit" type="submit">Xác nhận</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
