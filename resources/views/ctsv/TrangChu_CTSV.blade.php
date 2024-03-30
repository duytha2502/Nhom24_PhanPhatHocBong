@extends('ctsv.layout.master')

@section('title', 'Trang chủ')

@section('body')
    <style>
        /*container*/
        .container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .introduce-search {
            display: flex;
            margin-top: 2%;
            justify-content: left;
        }

        .introduce {
            padding: 0 20px
        }

        .introduce .btn-primary {
            background: #FF8800;
            text-align: center;
            font-weight: bold;
            color: white;
            margin-left: 5%;
            border: solid 1px black;
        }

        .search {
            margin-left: 30%;
            width: 500px;
        }

        .news {
            width: 100%;
            margin-top: 20px;
            display: block;
        }

        .content {
            width: 30%;
            min-height: 350px;
            margin-left: 2%;
            float: left;
            border: 1px solid black;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        Button a {
            text-decoration: none;
            color: aliceblue;
        }

        .description .signUp {
            background: #EF0909;
            color: white;
            padding: 10px 20px;
            border: 1px solid black;
            cursor: pointer;
            position: absolute;
            font-weight: bold;
            margin-top: 15px;
        }

        .banner img {
            width: 100%;
            height: 80pt;
            object-fit: cover;
        }

        .button-container-div {
            width: 100px;
            height: 100px;
            margin: 0 auto !important;
        }

        .signUp:hover {
            background-color: #ff9950;
        }

        .description h3 {
            color: #C31313;
            margin-left: 10px;
        }

        .description a {
            text-decoration: none;
        }

        .pdhb {
            margin-left: 10px;
        }

        .description p {
            font-weight: bold;
            margin-left: 10px;
        }

        .empty-text {
            margin-top: 5%;
            margin-bottom: 25%;
            font-size: 14pt;
            font-weight: bold;

        }
    </style>
    <!--main-->
    <div class="container">
        <div class="introduce-search">
            <div class="introduce">
                <a href="{{ route('create') }}" class="btn btn-primary">Tạo bài đăng</a>
            </div>
            <form action="{{ route('TimKiemHocBongSV') }}" method="POST" class="modal-content modal-body border-0 p-0">
                @csrf
                <div class="search input-group mb-2">
                    <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}"
                        placeholder="Nhập học bổng cần tìm">
                    <button id="btn_search" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>Tìm Kiếm
                    </button>
                </div>
            </form>
        </div>
        <div class="news">
            @forelse($hocbong as $key => $item)
                <div class="content">
                    <div class="banner">
                        <a href="/ctsv/CTHB/{{ $item->MaHB }}"><img src="{{ $item->Anh }}"></a>
                    </div>
                    <div class="description">
                        <h3>{{ $item->TenHocBong }}</h3>
                        <p>Số lượng tham gia: {{ $item->SoLuongThamGia }}</p>
                        <p>Hạn: {{ $item->NgayBatDau }} đến {{ $item->NgayKetThuc }}</p>
                        <a class="pdhb" href="/ctsv/DSPDHB/{{ $item->MaHB }}">Phê duyệt học bổng >></a>
                        <div class="button-container-div">
                            <button class="signUp"><a onclick="return confirm('Bạn có chắc chắn muốn gỡ bài?')"
                                    href="{{ url('/delete') . '/' . $item->MaHB }}">Gỡ bài</a></button>

                        </div>
                    </div>
                </div>
            @empty
                <p class="empty-text">Không tìm thấy học bổng <strong>{{ $search ?? '' }}</strong></p>
            @endforelse
        </div>
    </div>
@endsection
