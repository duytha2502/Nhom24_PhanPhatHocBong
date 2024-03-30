@extends('ctsv.layout.master')

@section('title', 'Danh sách phê duyệt học bổng')

@section('body')
    <style>
        body {
            background-color: #F1F1F1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
        }
        
        .title {
            margin-top: 50px;
            color: #C31313;
            text-align: center;
        }

        .container-fluid {
            flex-grow: 1;
            margin-top: 100px;
            border: 1px #001E3C solid;
            padding: 20px;
            margin-bottom: 50px;

        }


        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1em;
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

        .btn {
            display: block;
            width: 8em;
            margin: 0 auto;
            padding: 0.5em;
            text-align: center;
            background-color: #003C71;
            color: white;
            text-decoration: none;
            border-radius: 0.5em;
        }

        .btn:hover {
            background-color: yellowgreen;
        }


        .custom-container {
            max-width: 960px;
            /* change this value to adjust the width as needed */
        }
        .empty-textsv {
            margin-top: 15%;
            margin-bottom: 15%;
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }

    </style>
    <!--main-->
    <div class="title">
        <h1>Danh Sach Phê Duyệt</h1>
    </div>
    <div class="container-fluid custom-container">
        <h5>{{$hocbong->TenHocBong}}</h5>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Họ và tên</th>
                        <th>Lớp</th>
                        <th>Ngày đăng ký</th>
                        <th>Trạng thái</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dsPD as $index => $value)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$value->MaSV}}</td>
                        <td>{{$value->TenSV}}</td>
                        <td>{{$value->TenLop}}</td>
                        <td>{{$value->NgayDangKy}}</td>
                        <td>
                                @if( $value->TinhTrang === 1)
                                    Đã duyệt
                                @elseif($value->TinhTrang === -1)
                                    Đang chờ duyệt
                                @else
                                    Đã huỷ duyệt
                                @endif
                        </td>
                        @if($value->TinhTrang === 1 || $value->TinhTrang === 0)
                            <td><a href="" class="btn">Xem chi tiết</a></td>
                        @else                       
                        <td><a href="/ctsv/CTPDHB/{{$value->MaPhieu}}" class="btn">Xem chi tiết</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @empty($value)
                <p class="empty-textsv">Chưa có sinh viên đăng ký.</p>
            @endempty
        </div>
    </div>

@endsection
