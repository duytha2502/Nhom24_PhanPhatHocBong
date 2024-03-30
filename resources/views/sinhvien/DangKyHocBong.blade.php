@extends('sinhvien.layout.master')

@section('title', 'Đăng ký học bổng')

@section('body')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
            margin-top: 15px;
            color: #1d009d;
        }

        .form-up-img {
            margin-top: 30px;
            width: 50%;
            padding: 0 10px;
            border: 1px solid black;
            border-radius: 5px;
            display: inline-block;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .imgPreview img {
            padding: 8px;
            max-width: 150px;
        }
        .row-2 {
            width: 45%;
            
            text-align: left;
        }
        .row-2 img {
            height: 100px;
            width: 100%;
            object-fit: fill;
        }
        footer {
            position: fixed;
            bottom: 0;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>ĐĂNG KÝ HỌC BỔNG</h1>
        </div>
        <div class="comment-area-box media">
            <div class="row-2">
                <img alt="" src="{{$hocbong->Anh}}" class="img-fluid float-left mr-3 mt-2">
            </div>
            
            <div class="row-2">
                <div class="media-body ml-4">
                    <h4 class="mb-0" style="color: #C31313"> {{ $hocbong->TenHocBong }} </h4>
                    <span class="date-comm font-sm text-capitalize text-color">Hạn từ <b>{{$hocbong->NgayBatDau}}</b> đến <b>{{$hocbong->NgayKetThuc}}</b></span>
                    <p>Số suất học bổng: {{$hocbong->SoLuongThamGia}}</p>
                </div>
            </div>
        </div>
        <div class="comment-content mt-3">
            <p><u>Thông tin học bổng:</u> {{$hocbong->MoTa}}</p>
        </div>
    
        <div class="form-up-img">
            <h3 class="text-center mb-5">Chọn ảnh minh chứng</h3>
            <form action="{{route('DangKyHB', $hocbong->MaHB)}}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
    
                @if ($message = Session::get('fail'))
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
    
                <div class="user-image mb-3 text-center">
                    <div class="imgPreview"> </div>
                </div>            
    
                <div class="custom-file">
                    <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                    <label class="custom-file-label" for="images">Chọn ảnh</label>
                </div>
                <div class="button-container">
                    <button type="submit"  style="margin: 0;" name="submit" class="btn btn-primary btn-block mt-4">Xác nhận</button>                   
                </div>
            </form>
            <button id="clearFilesBtn" style="margin-top:3% !important" class="btn btn-outline-danger m-1" onclick="clearFiles()">Xóa ảnh</button>           
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session::get('condition'))
        <script>
            Swal.fire({
                title: 'Chúc Mừng!',
                text: "Bạn đã đăng ký thành công!",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Trang Chủ'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Chuyển hướng trang
                    location.href = "{{ route('TrangChu_SV') }}";
                }
            });
        </script>
    @endif
    <script>
        function clearFiles() {
            var fileInput = document.getElementById('images');
            fileInput.value = null;
            $('div.imgPreview').empty();
        }
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });    
    </script>
@endsection
