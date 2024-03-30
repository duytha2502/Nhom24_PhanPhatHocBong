
@extends('ctsv.layout.master')

@section('title', 'Tạo bài đăng')

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
        }

        .title {
            margin-top: 50px;
            color: #C31313;
        }

        .form-update {
            margin-top: 30px;
            height: 730px;
            width: 400px;
            background: #21C3E0;
            border: 1px solid black;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 30px;
        }

        .text-input-sv input {
            padding: 5px;
            float: right;
            margin-right: 20px;
            width: 200px;
            margin-top: 20px;
        }

        .text-input-sv label {
            margin-top: 30px;
            margin-left: 20px;
            font-weight: bold;
        }

        .text-textarea{
            display: flex;
        }
        .text-textarea label {
            font-weight: bold;
            margin-left: 70px;
        }

        .text-textarea textarea {
            margin-top: 20px;
            font-weight: bold;
            margin-left: 65px;
            width: 200px;
            height: 100px;
        }

        form button {
            padding: 10px;
            max-width: 200px;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px;
        }

        form button a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
    <!--main-->
    <div class="container">
        <div class="title">
            <h1>TẠO BÀI ĐĂNG</h1>
            @if(session('success'))
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
            <form method='post' action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="text-input-sv">
                    <label>Tên học bổng</label>
                    <input type="text" id="tenHocBong" name="tenHocBong" required placeholder="Tên học bổng">
                </div>
                <div class="text-input-sv">
                    <label>Số suất học bổng</label>
                    <input type="number" id="soLuongThamGia" name="soLuongThamGia" required placeholder="Số suất">
                </div>
                <div class="text-input-sv">
                    <label>Đối tượng</label>
                    <input type="text" id="doiTuong" name="doiTuong" required placeholder="Đối tượng">
                </div>
                <div class="text-input-sv">
                    <label>Nhà tài trợ</label>
                    <input type="text" id="nhaTaiTro" name="nhaTaiTro" required placeholder="Nhà tài trợ">
                </div>
                <div class="text-input-sv">
                    <label>Tiêu chí</label>
                    <input type="text" id="tieuChi" name="tieuChi" required placeholder="Tiêu chí đánh giá">
                </div>
                <div class="text-input-sv">
                    <label>Ngày bắt đầu</label>
                    <input type="date" id="ngayBatDau" name="ngayBatDau" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="text-input-sv">
                    <label>Ngày kết thúc</label>
                    <input type="date" id="ngayKetThuc" name="ngayKetThuc" required
                        min="{{ date('Y-m-d') }}" onchange="validateDateRange()">
                </div>

                <div class="text-input-sv">
                    <label >Ảnh mô tả</label>
                    <input type="file" name="anh" required accept="image/*" id="anh">
                </div>
                <div class="text-textarea">
                    <label style="margin-top: 20px">Mô tả</label>
                    <textarea class="form-control" id="moTa" name="moTa" placeholder="Mô tả"></textarea>
                </div>
                <button type="submit"  style="margin: 0 auto;" name="submit" class="btn btn-primary btn-block mt-4">Xác nhận</button>
            </form>
        </div>
    </div>
    <!-- Javascript code -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('condition'))
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
                    location.href = "{{ route('TrangChu_CTSV') }}";
                }
            });
        </script>
    @endif
    <script>
        function validateDateRange() {
            var ngayBatDauInput = document.getElementById('ngayBatDau');
            var ngayKetThucInput = document.getElementById('ngayKetThuc');
            
            var ngayBatDau = new Date(ngayBatDauInput.value);
            var ngayKetThuc = new Date(ngayKetThucInput.value);
            
            if (ngayKetThuc < ngayBatDau) {
                ngayKetThucInput.setCustomValidity('Ngày kết thúc phải sau ngày bắt đầu.');
            } else {
                ngayKetThucInput.setCustomValidity('');
            }
        }
    </script>
@endsection
