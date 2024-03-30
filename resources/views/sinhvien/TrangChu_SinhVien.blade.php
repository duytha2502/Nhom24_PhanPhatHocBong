@extends('sinhvien.layout.master')
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
            align-items: center;
        }

        .introduce {
            padding: 10px;
            font-size: 20px;
            background: #FF8800;
            text-align: center;
            font-weight: bold;
            color: white;
            margin-left: 20px;
            margin-top: 0;
        }

        .search {
            margin-left: 20%;
            width: 500px;
        }

        .news {
            width: 100%;
            margin-top: 20px;
            display: block;
        }

        a {
            text-decoration: none;
            color: aliceblue;
        }

        .content {
            width: 30%;
            min-height: 330px;
            display: flex;
            margin-left: 2%;
            float: left;
            border: 1px solid black;
            margin-top: 20px;
            margin-bottom: 20px;
            flex-direction: column;
        }

        .banner img {
            width: 100%;
            height: 80pt;
            object-fit: cover;
        }

        .description .signUp {
            background: #EF0909;
            color: white;
            padding: 10px 20px;
            border: 1px solid black;
            cursor: pointer;
            position: absolute;
            font-weight: bold;
        }

        .button-container-div {
            width: 100px;
            height: 100px;
            margin: 0 auto !important;
        }

        .description h3 {
            color: #C31313;
            margin-left: 10px;
        }

        .description p {
            font-weight: bold;
            margin-left: 10px;
        }

        .empty-textsv {
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
                <span>Các học bổng đang được đăng ký </span>
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
                        <a href="/CTHB/{{ $item->MaHB }}"><img src="{{ $item->Anh }}"></a>
                    </div>
                    <div class="description">
                        <h3>{{ $item->TenHocBong }}</h3>
                        <p>Số suất học bổng: {{ $item->SoLuongThamGia }}</p>
                        <p>Hạn: {{ $item->NgayBatDau }} đến {{ $item->NgayKetThuc }}</p>
                        <div class="button-container-div">
                            <button class="signUp"><a href="{{ route('ShowDangKyHB', $item->MaHB) }}">Đăng Ký</a></button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="empty-textsv">Không tìm thấy học bổng <strong>{{ $search ?? '' }}</strong></p>
            @endforelse
        </div>
    </div>
@endsection
